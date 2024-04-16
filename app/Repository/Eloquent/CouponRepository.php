<?php

namespace App\Repository\Eloquent;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Field;
use App\Repository\CategoryRepositoryInterface;
use App\Repository\CouponRepositoryInterface;
use App\Repository\FieldRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CouponRepository extends Repository implements CouponRepositoryInterface
{
    protected Model $model;

    public function __construct(Coupon $model)
    {
        parent::__construct($model);
    }

    public function isValid($coupon)
    {
        return $this->model::query()->where('coupon', strtolower($coupon))->active()->exists();
    }

    public function stillUsable($coupon){
        $coupon = $this->model::query()->where('coupon', strtolower($coupon))->withCount('carts' , 'cartItems')->first();
        $usesCount = $coupon->carts_count + $coupon->cart_items_count;
        $maxUsesCount = $coupon->max_uses;
        if ($maxUsesCount == null)
            return true;
        elseif($maxUsesCount <= $usesCount)
        {
            return false;
        }
        return true;
    }

    public function isUsedBefore($coupon)
    {
        return $this->model::query()
            ->where('coupon', strtolower($coupon))
            ->where(function ($query) {
                $query->whereHas('carts', function ($query) {
                    $query->where('user_id', auth('api')->id())->withTrashed();
                });
            })
            ->withTrashed()
            ->exists();
    }

    public function isMobilOnly($coupon)
    {
        return $this->model::query()->where('coupon',$coupon)->where('mobile_only', 1)->exists();
    }

}
