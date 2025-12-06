<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSliderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'banner' => ['required', 'image'],
            'btn_url' => ['nullable', 'url'],
            'serial' => ['required', 'integer'],
            'status' => ['required'],

            'title' => ['required', 'array'],
            'title.*' => ['required', 'string'],

            'type' => ['required', 'array'],
            'type.*' => ['required', 'string'],

            'starting_price' => ['required', 'array'],
            'starting_price.*' => ['required', 'string'],
        ];
    }
}
