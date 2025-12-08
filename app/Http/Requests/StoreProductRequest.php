<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'thumb_image' => ['required', 'image'],

            'category' => ['required'],
            'sub_category' => ['nullable'],
            'child_category' => ['nullable'],

            'price' => ['required'],
            'qty'   => ['required'],

            'sku' => ['nullable', 'string'],
            'offer_price' => ['nullable'],
            'offer_start_date' => ['nullable'],
            'offer_end_date' => ['nullable'],

            'product_type' => ['required'],
            'status' => ['required'],

        ];
    }
}
