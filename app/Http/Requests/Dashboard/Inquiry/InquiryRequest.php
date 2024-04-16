<?php

namespace App\Http\Requests\Dashboard\Inquiry;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InquiryRequest extends FormRequest
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
            'answer' => [Rule::requiredIf(is_null($this->answer_voice))],
            'is_public' => 'nullable',
            'answer_voice' => [Rule::requiredIf(is_null($this->answer))]
//            'answer_image' => 'nullable',
//            'answer_voice' => 'nullable',
        ];
    }
}
