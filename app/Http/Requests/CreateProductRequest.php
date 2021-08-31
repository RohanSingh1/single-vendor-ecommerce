<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'nullable|string|max:255',
            'purchased_price' => 'nullable|numeric|min:1|max:999999999',
            'price' => 'nullable|numeric|min:1|max:999999999',
            'old_price' => 'nullable|numeric|min:1|max:999999999',
            'quantity' => 'nullable|string|max:255',
            'model_no' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'category_id' => 'required',
            'description' => 'nullable|string|max:1699999',
        ];
    }
}
