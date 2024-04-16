<?php

namespace App\Http\Requests\Dashboard\Coupons;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'coupon' => ['required','max:255' , Rule::unique('coupons' , 'coupon')->ignore($this->route('coupon'))],
            'discount' => 'required|numeric|min:1|max:100',
            'max_uses' => 'nullable|numeric|min:1',
            'couponable_id' => 'nullable',
            'couponable_type' => 'nullable',
            'is_active' => 'nullable',
            'mobile_only' => 'nullable',
        ];
    }
}
