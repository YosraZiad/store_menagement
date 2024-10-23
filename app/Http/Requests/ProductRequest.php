<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'barcode' => 'nullable|string|max:191',
            'price' => 'nullable|numeric',
            'unit' => 'nullable|integer',
            'category' => 'nullable|integer',
        ];
    }

    /**
     * Get the custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'The product name is required.',
            'name.string' => 'The product name must be a string.',
            'name.max' => 'The product name must not exceed 255 characters.',
            'description.string' => 'The description must be a string.',
            'description.max' => 'The description must not exceed 255 characters.',
            'barcode.string' => 'The barcode must be a string.',
            'barcode.max' => 'The barcode must not exceed 191 characters.',
            'price.numeric' => 'The price must be a number.',
            
        ];
    }
}
