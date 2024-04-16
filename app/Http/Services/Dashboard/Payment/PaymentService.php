<?php

namespace App\Http\Services\Dashboard\Payment;

use App\Models\CertificateUser;
use App\Models\Course;
use App\Models\CourseBook;
use App\Repository\BookUserRepositoryInterface;
use App\Repository\CertificateUserRepositoryInterface;
use App\Repository\CourseUserRepositoryInterface;
use App\Repository\PaymentItemRepositoryInterface;
use App\Repository\PaymentRepositoryInterface;
use App\Repository\PrintRequestRepositoryInterface;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class PaymentService
{
    private PaymentRepositoryInterface $paymentRepository;
    private BookUserRepositoryInterface $bookUserRepository;
    private CourseUserRepositoryInterface $courseUserRepository;
    private PrintRequestRepositoryInterface $printRequestRepository;
    private CertificateUserRepositoryInterface $certificateUserRepository;
    private PaymentItemRepositoryInterface $paymentItemRepository;
    private array $payable = [
//      cartable_type => method
        Course::class => 'giveCourseAccess',
        CourseBook::class => 'orderBook',
        CertificateUser::class => 'orderCertificate'
    ];

    public function __construct(
        PaymentRepositoryInterface $paymentRepository,
        BookUserRepositoryInterface $bookUserRepository,
        CourseUserRepositoryInterface $courseUserRepository,
        PrintRequestRepositoryInterface $printRequestRepository,
        CertificateUserRepositoryInterface $certificateUserRepository,
        PaymentItemRepositoryInterface $paymentItemRepository,
    )
    {
        $this->paymentRepository = $paymentRepository;
        $this->bookUserRepository = $bookUserRepository;
        $this->courseUserRepository = $courseUserRepository;
        $this->printRequestRepository = $printRequestRepository;
        $this->certificateUserRepository = $certificateUserRepository;
        $this->paymentItemRepository = $paymentItemRepository;
    }

    public function confirm($id)
    {
        $payment = $this->paymentRepository->getById($id);
//        if(Gate::allows('confirm-payment', $payment)) {
        DB::beginTransaction();
        try {
            $this->paymentRepository->update($id, ['is_confirmed' => true]);
            if (!($payment->payable_type == CertificateUser::class)) {
//                    $cartItems = $payment->payable()?->withTrashed()->first()->items;
//                    foreach ($cartItems as $cartItem) {
//                        $this->{$this->payable[$cartItem->cartable_type]}($payment, $cartItem);
//                    }
//                    $payment->payable()?->delete();
            } else {
                $certificate = $this->certificateUserRepository->getById($payment->payable_id);
                $printRequest = $this->printRequestRepository->create([
                    'user_id' => $payment->user_id,
                    'type' => 'CERTIFICATE',
                    'course_id' => $certificate->course_id,
                    'payment_id' => $payment->id,
                ]);
                $certificate->update([
                    'print_request_id' => $printRequest->id,
                    'is_active' => true,
                ]);
            }
            DB::commit();
            return redirect()->route('payments.show', $id)->with(['success' => __('messages.Payment confirmed successfully')]);
        } catch (Exception $e) {
            //return $e;
            DB::rollBack();
            return redirect()->route('payments.show', $id)->with(['error' => __('messages.Something went wrong')]);
        }
//        } else {
//            return refresh();
//        }
    }

    public function decline($id) {
        $payment = $this->paymentRepository->getById($id);
//        if(Gate::allows('decline-payment', $payment)) {
        DB::beginTransaction();
        try {
            $this->paymentRepository->update($id, ['is_declined' => true]);
            if (($payment->payable_type == CertificateUser::class)) {
                $payment->printRequests()->delete();
            }
            DB::commit();
            return redirect()->route('payments.show', $id)->with(['success' => __('messages.Payment declined successfully')]);
        } catch (Exception $e) {
            DB::rollBack();
//                //return $e->getMessage();
            return redirect()->route('payments.show', $id)->with(['error' => __('messages.Something went wrong')]);
        }
//        } else {
//            return refresh();
//        }
    }

    private function giveCourseAccess($payment, $cartItem) {
        return $payment->user->courses()->attach(
            $cartItem->cartable_id,
            [
                'payment_id' => $payment->id,
                'is_active' => true,
            ]
        );
    }

    private function orderBook($payment, $cartItem) {
//        dd($cartItem->cartable);
        if ($cartItem->option == 'PDF') {
            return $this->bookUserRepository->create([
                'user_id' => $payment->user_id,
                'course_book_id' => $cartItem->cartable_id,
                'payment_id' => $payment->id,
                'is_active' => true,
            ]);
        } elseif ($cartItem->option == 'PRINT') {
            return $payment->user->printRequests()->create([
                'type' => 'BOOK',
                'course_id' => $cartItem->cartable?->course_id,
                'book_id' => $cartItem->cartable_id,
                'payment_id' => $payment->id,
            ]);
        }
    }

    public function confirmCourse($payment , $course_id , $user_id)
    {
        DB::beginTransaction();
        try
        {
            $oldcourse = Course::find($course_id);
            $end_subscribe = null;
            if($oldcourse->dayNumbers)
            {
                $enddate = Carbon::parse(now())->addDays($oldcourse->dayNumbers);
                $end_subscribe = $enddate->toDateString();
            }
            $courseUser = $this->courseUserRepository->create([
                                                                    'payment_id' => $payment->id,
                                                                    'course_id' =>$course_id,
                                                                    'user_id' => $user_id,
                                                                    'is_active' => true,
                                                                    'end_subscribe' => $end_subscribe,
                                                                ]);
            $this->paymentItemRepository->create([
                'user_id' => $user_id,
                'name_ar' => __('dashboard.course', locale: 'ar') . ': ' . $courseUser->course->name_ar,
                'name_en' => __('dashboard.course', locale: 'en') . ': ' . $courseUser->course->name_en,
                'amount' => $courseUser->course->price,
                'discounted_amount' => $payment->payable()->withTrashed()->first()?->coupon ? ( 1 - ($payment->payable()->withTrashed()->first()?->coupon->discount / 100) ) * $courseUser->course->price : $courseUser->course->price,
            ]);
            DB::commit();
            return redirect()->back()->with(['success' => __('messages.Subscription Added Successfully')]);

        }
        catch (Exception $e)
        {
            DB::rollBack();
            return redirect()->back()->with(['error' => __('messages.Something went wrong')]);
        }

    }

    public function confirmBook($payment , $book_id , $user_id ,  $type){
        DB::beginTransaction();
        try {
            if ($type == "PDF") {
                $bookUser = $this->bookUserRepository->create([
                    'payment_id' => $payment->id,
                    'course_book_id' => $book_id,
                    'user_id' => $user_id,
                    'is_active' => true
                ]);
                $amount = $bookUser->book?->course?->price ?? $bookUser->book?->price;
                $this->paymentItemRepository->create([
                    'user_id' => $user_id,
                    'name_ar' => __('dashboard.courseBook', locale: 'ar') . ': ' . $bookUser->book->name_ar,
                    'name_en' => __('dashboard.courseBook', locale: 'en') . ': ' . $bookUser->book->name_en,
                    'amount' => $amount,
                    'discounted_amount' => $payment->payable()->withTrashed()->first()?->coupon ? ( 1 - ($payment->payable()->withTrashed()->first()?->coupon->discount / 100) ) * $amount : $amount,
                ]);

                // dd($payment->payable()->withTrashed()->first()->items()->where('option', 'PDF')->where('cartable_id', $book_id)->get());

                $this->notify($payment->user, $payment->payable()->withTrashed()->first()->items()->where('option', 'PDF')->where('cartable_id', $book_id)->get());

            }else{
                $itemQuantity = $payment->payable()?->withTrashed()->first()->items()?->where('cartable_type', CourseBook::class)->where('cartable_id', $book_id)?->sum('quantity');
                // dd($payment->payable()->withTrashed()->get());
                $printRequest = $this->printRequestRepository->create([
                    'payment_id' => $payment->id,
                    'user_id' => $user_id,
                    'type' => 'BOOK',
                    'book_id' => $book_id,
                    'quantity' => $itemQuantity,
                ]);
                $this->paymentItemRepository->create([
                    'user_id' => $user_id,
                    'name_ar' => __('dashboard.printRequest', locale: 'ar') . ': ' . $printRequest->book->name_ar,
                    'name_en' => __('dashboard.printRequest', locale: 'en') . ': ' . $printRequest->book->name_en,
                    'quantity' => $itemQuantity,
                    'amount' => $itemQuantity * $printRequest->book->price,
                    'discounted_amount' => $payment->payable()->withTrashed()->first()?->coupon ? $itemQuantity * (( 1 - ($payment->payable()->withTrashed()->first()?->coupon->discount / 100) ) * $printRequest->book->price) : $itemQuantity * $printRequest->book->price,
                ]);
            }
            DB::commit();
            return redirect()->back()->with(['success' => __('messages.Subscription Added Successfully')]);
        }catch (Exception $e){
            DB::rollBack();
            dd($e);
            return redirect()->back()->with(['error' => __('messages.Something went wrong')]);
        }

    }

    public function notify($user, $notifiable_items) {
        if (env('APP_ENV') == 'production') {
            Mail::send(
                'emails.items_activated',
                [
                    'user' => $user,
                    'notifiable_items' => $notifiable_items
                ],
                function ($message) use ($user, $notifiable_items) {
                    $message->to($user->email, $user->name);
                    $message->subject('تم تفعيل ' . ($notifiable_items->count() == 1 ? 'كتاب' : $notifiable_items->count() . 'كتب') . ' في حسابك ');
                    $message->from(env('PRODUCTION_NO_REPLY_MAIL'), 'منصة ميم التعليمية');
                }
            );
        }

    }


}
