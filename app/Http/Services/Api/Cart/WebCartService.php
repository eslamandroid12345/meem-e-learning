<?php

namespace App\Http\Services\Api\Cart;
use App\Http\Requests\Api\Cart\ApplyCouponCartRequest;

class WebCartService extends CartService
{
    private function provide() 
    {
        return $this->cartRepository->provide();
    }

    public function applyCoupon(ApplyCouponCartRequest $request)
    {
        $cart = $this->provide();
        $data = $request->validated();
        $coupon = $data['coupon'];
        if ($this->couponRepository->isValid($coupon) && !$this->couponRepository->isMobilOnly($coupon))
        {
            if ($this->couponRepository->stillUsable($coupon))
                if (!$this->couponRepository->isUsedBefore($coupon))
                {
                    $couponId = $this->couponRepository->first('coupon', $coupon, ['id'])->id;
                    return $this->handleCoupon($couponId , $cart);
                }
                else
                {
                    return $this->responseFail(status: 401, message: __('messages.You have used this coupon before'));
                }
            else
            {
                return $this->responseFail(status: 401, message: __('messages.coupon has used max times'));
            }
        }
        else
        {
            return $this->responseFail(status: 401, message: __('messages.Coupon is invalid'));
        }
    }

    private function handleCoupon($couponId , $cart)
    {
        $coupon = $this->couponRepository->getById($couponId);
        $cart->items()->update(['coupon_id' => null]);
        $cartItems = $cart->items;
        if ($coupon->couponable_type  != null)
        {
            $cart->update(['coupon_id' => null]);
            foreach ($cartItems as $item)
            {
                if ($item->cartable_type == $coupon->couponable_type && $item->cartable_id == $coupon->couponable_id)
                {
                    $item->update([
                                    'coupon_id' => $couponId
                                ]);
                    return $this->responseSuccess(message:  __('messages.discount applied To') . $item->cartable->t('name'));
                }
            }
            return $this->responseFail(status: 401, message: __('messages.Coupon is not active with this items'));
        }
        else
        {
            $this->cartRepository->update($cart->id, ['coupon_id' => $couponId]);
            return $this->responseSuccess(message: __('messages.Coupon is correct'));
        }
    }
}
