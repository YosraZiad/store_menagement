<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProviderRequest extends FormRequest
{
  
  /**
     * Determine if the user is    authorized to make this request.
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
            'full_name'     => 'required|string|min:5|unique:units,name',
            'brief'         => 'string|max:255',
            'short_name'    => 'string',
            'field'         => 'required',
            'cr_number'     => 'numeric',
            'vat_number'    => 'numeric'
        ];
    }

    /**
     * Get custom validation messages (optional).
     *
     * @return array
     */
    public function messages()
    {
        return [
            'full_name.required'    => 'The provider name is required.',
            'full_name.string'      => 'The provider name must be a string.',
            'full_name.min'         => 'The provider name may not be greater than 255 characters.',
            'full_name.unique'      => 'The provider name already exists.',

            'brief.max'             => 'The The provider about info may not be greater than 255 characters.',
            'brief.string'          => 'The description must be a type of string.',

            'short_name.string'     => 'The short name must be a string.',
            'cr_number.numeric'     => 'The short name must be a number.',
            'cr_number.numeric'     => 'The short name must be a number.',
            
        ];
    }

    }
