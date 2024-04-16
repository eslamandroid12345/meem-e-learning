<?php

namespace App\Http\Services\Api\Payment;

use App\Http\Requests\Api\Payment\PaymentRequest;
use App\Http\Requests\Payment\PaymentCallbackRequest;
use App\Http\Services\Mutual\FileManagerService;
use App\Http\Traits\Responser;
use App\Repository\BookUserRepositoryInterface;
use App\Repository\CartRepositoryInterface;
use App\Repository\CertificateUserRepositoryInterface;
use App\Repository\CourseRepositoryInterface;
use App\Repository\CourseUserRepositoryInterface;
use App\Repository\PaymentRepositoryInterface;
use App\Repository\PrintRequestRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

abstract class PaymentService
{
    use Responser, Payable;

    protected PaymentRepositoryInterface $paymentRepository;
    protected CartRepositoryInterface $cartRepository;
    protected CourseRepositoryInterface $courseRepository;
    protected CourseUserRepositoryInterface $courseUserRepository;
    protected BookUserRepositoryInterface $bookUserRepository;
    protected PrintRequestRepositoryInterface $printRequestRepository;
    protected CertificateUserRepositoryInterface $certificateUserRepository;
    protected PaymentAssignService $assign;
    protected FileManagerService $fileManager;

    public function __construct(
        PaymentRepositoryInterface      $paymentRepository,
        CartRepositoryInterface         $cartRepository,
        CourseRepositoryInterface       $courseRepository,
        CourseUserRepositoryInterface   $courseUserRepository,
        BookUserRepositoryInterface     $bookUserRepository,
        PrintRequestRepositoryInterface $printRequestRepository,
        CertificateUserRepositoryInterface $certificateUserRepository,
        PaymentAssignService            $assignService,
        FileManagerService              $fileManagerService,
    )
    {
        $this->paymentRepository = $paymentRepository;
        $this->cartRepository = $cartRepository;
        $this->courseRepository = $courseRepository;
        $this->courseUserRepository = $courseUserRepository;
        $this->bookUserRepository = $bookUserRepository;
        $this->printRequestRepository = $printRequestRepository;
        $this->certificateUserRepository = $certificateUserRepository;
        $this->assign = $assignService;
        $this->fileManager = $fileManagerService;
    }

    public function ePaymentCallback(PaymentCallbackRequest $request)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('TAP_PAYMENT_SK'),
            'accept' => 'application/json',
        ])->get("https://api.tap.company/v2/charges/{$request->tap_id}")->json();

        Log::info('payment::: '. print_r($response, true));

        if (isset($response['metadata'])) {
            $payment = $this->paymentRepository->getById($response['metadata']['udf3']);

            if (isset($response['status']) && $response['status'] == 'CAPTURED') {

                if (!$payment->is_confirmed) {
                    if ($payment->payable !== null) {
                        $this->assign->handle($payment, $response['metadata']['udf4'], true);
                    }

                    $this->paymentRepository->update($payment->id, ['is_confirmed' => true, 'is_declined' => false]);
                }

                return $this->responseSuccess(message: __('messages.Payment completed successfully'));
            } else {
                $this->paymentRepository->update($payment->id, ['is_declined' => true, 'is_confirmed' => false]);
                if (isset($response['response'])) {
                    return $this->responseFail(message: __('messages.Payment failed because', ['cause' => $response['response']['message']]));
                } else {
                    return $this->responseFail(message: __('messages.An error occurred while processing the payment'));
                }
            }
        } else {
            return $this->responseFail(message: __('messages.An error occurred while processing the payment'));
        }
    }

    public function ePaymentWebhook(Request $request) {
        Log::info('webhook started');
        $payment = $this->paymentRepository->getById($request->metadata['udf3']);

        if ($request->status == 'CAPTURED') {

            $this->assign->handle($payment, $request->metadata['udf4'], true);

            $this->paymentRepository->update($payment->id, ['is_confirmed' => true, 'is_declined' => false]);

            Log::info('webhook done');
            return true;
        } else {
            $this->paymentRepository->update($payment->id, ['is_declined' => true, 'is_confirmed' => false]);
            Log::info('webhook canceled');
            return false;
        }
    }

    public function tamaraNotification(Request $request)
    {
        Log::info(print_r($request, true));
        return true;
    }
}
