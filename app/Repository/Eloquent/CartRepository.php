<?php

namespace App\Repository\Eloquent;

use App\Models\Answer;
use App\Models\Cart;
use App\Models\Course;
use App\Repository\AnswerRepositoryInterface;
use App\Repository\CartRepositoryInterface;
use App\Repository\QuestionRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CartRepository extends Repository implements CartRepositoryInterface
{
    protected Model $model;

    public function __construct(Cart $model){
        parent::__construct($model);
    }

    public function provide() {
        return $this->model::query()->firstOrCreate(['user_id' => auth('api')->id()]);
    }

    public function getLeftCarts() {
        $carts =  $this->model::query()->whereHas('items' , function ($query){
            if (request()->has('course') && request('course') != "ALL" ){
                $query->where(['cartable_type' => Course::class  , 'cartable_id' => request('course')]);
            }
        });
        if (request()->has('search') && request('search') != null){
            $carts->whereHas('user' , function ($query) {
                $query->where('name' , 'LIKE' , '%' . \request('search') . '%')->orWhere('email' , 'LIKE' , '%' .\request('search') . '%')
                    ->orWhere('phone' , 'LIKE' , '%' . \request('search') . '%');
            });
        }
        if (\request()->has('from_date') && \request('from_date') != ""){
            $carts->whereDate('created_at' , '>=' , \request('from_date'));
        }
        if (\request()->has('to_date') && \request('to_date') != ""){
            $carts->whereDate('created_at' , '<=' , \request('to_date'));
        }


        return $carts;
    }

    public function isPayable($cart_id) {
        return $this->model::query()
            ->where('carts.id', $cart_id)
            ->where('user_id', auth('api')->id())
            ->whereHas('items')
            ->exists();
    }

}
