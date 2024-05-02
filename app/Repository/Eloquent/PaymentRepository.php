<?php

namespace App\Repository\Eloquent;

use App\Models\Cart;
use App\Models\CertificateUser;
use App\Models\Course;
use App\Models\CourseBook;
use App\Models\Payment;
use App\Repository\PaymentRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PaymentRepository extends Repository implements PaymentRepositoryInterface
{
    protected Model $model;

    public function __construct(Payment $model)
    {
        parent::__construct($model);
    }

    public function confirm($paymentId) {
        return $this->model::query()->where('id', $paymentId)->where('is_confirmed', 0)->update(['is_confirmed' => 1]);
    }

    public function getOrderedPayments() {
         $payments = $this->model::query()->where('is_confirmed' , true)->orderBy('is_confirmed')->orderByDesc('created_at')->where(function ($query) {
             if (request()->has('type') && request('type') != "ALL"){
                 if (request('type') == "CERTIFICATE"){
                     $query->where('payable_type' , CertificateUser::class);
                 }else{
                     if (request('type') == "COURSE"){

                         $query->whereHasMorph('payable' , Cart::class , function (Builder $query){
                             $query->withTrashed()->whereHas('items' , function ($query){
                                 $query->where('cartable_type' , Course::class)->withTrashed();
                             });
                         });

                     }elseif (request()->has('course_id') && request('course_id') != null){

                         $query->whereHasMorph('payable' , Cart::class , function (Builder $query){
                             $query->withTrashed()->whereHas('items' , function ($query){
                                 $query->where('cartable_type' , Course::class)->where('cartable_id',request('course_id'))->withTrashed();
                             });
                         });
                     } else{
                         $query->whereHasMorph('payable' , Cart::class , function (Builder $query){
                             $query->withTrashed()->whereHas('items' , function ($query){
                                 $query->where('cartable_type' , CourseBook::class)->withTrashed();
                             });
                         });
                     }
                 }
             }
             if (request()->has('payment_type') && request('payment_type') != "ALL") {
                 $query->where('payment_type', request('payment_type'));
             }
             if (request()->has('search') && request('search') != null){
                 $query->where(function ($query) {
                     $query->where('phone' , request('search'))->orWhere(function ($query){
                         $query->whereHas('user' , function ($query){
                             $query->where('phone' , 'LIKE' , '%' .  request('search') . '%');
                         });
                     });
                 });
             }
             if (request()->has('from_date') && request('from_date') != ""){
                 $query->whereDate('created_at' , '>=' , request('from_date'));
             }
             if (request()->has('to_date') && request('to_date') != ""){
                 $query->whereDate('created_at' , '<=' , request('to_date'));
             }

         });

         return $payments;
    }
    public function getBankTransfers() {
        $payments = $this->model::query()->where('payment_type' ,'=', 'CASH')
            ->where(function ($query) {
                $query->where('is_confirmed', false);
                $query->where('is_declined', false);
            })
            ->orderByDesc('created_at')->where(function ($query) {
            if (request()->has('type') && request('type') != "ALL"){
                if (request('type') == "CERTIFICATE"){
                    $query->where('payable_type' , CertificateUser::class);
                }else{
                    if (request('type') == "COURSE"){
                        $query->whereHasMorph('payable' , Cart::class , function (Builder $query){
                            $query->withTrashed()->whereHas('items' , function ($query){
                                $query->where('cartable_type' , Course::class)->withTrashed();
                            });
                        });
                    }else{
                        $query->whereHasMorph('payable' , Cart::class , function (Builder $query){
                            $query->withTrashed()->whereHas('items' , function ($query){
                                $query->where('cartable_type' , CourseBook::class)->withTrashed();
                            });
                        });
                    }
                }
            }
            if (request()->has('search') && request('search') != null){
                $query->where(function ($query) {
                    $query->where('phone' , request('search'))->orWhere(function ($query){
                        $query->whereHas('user' , function ($query){
                            $query->where('phone' , 'LIKE' , '%' .  request('search') . '%');
                        });
                    });
                });
            }
            if (request()->has('from_date') && request('from_date') != ""){
                $query->whereDate('created_at' , '>=' , request('from_date'));
            }
            if (request()->has('to_date') && request('to_date') != ""){
                $query->whereDate('created_at' , '<=' , request('to_date'));
            }
        });
        return $payments;
    }


    public function getPaymentsCount(){
        return $this->model::query()->where('is_confirmed' , true)->count();
    }

    public function notActivatedCount() {
        return $this->model::query()->where('payment_type' ,'=', 'CASH')->where('is_confirmed', 0)->where('is_declined', 0)->count();
    }
}
