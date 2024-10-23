<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnitRequest extends FormRequest
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
            'name' => 'required|string|min:5|unique:units,name',
            'description' => 'required|string|max:255',
            'short_name' => 'required|string|unique:units,short_name',
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
            'name.required' => 'The unit name is required.',
            'name.string' => 'The unit name must be a string.',
            'name.min' => 'The unit name may not be greater than 3 characters.',
            'name.unique' => 'The unit name already exists.',

            'description.required' => 'The description is required.',
            'description.string' => 'The description must be a string.',

            'short_name.required' => 'The short name is required.',
            'short_name.string' => 'The short name must be a string.',
            'short_name.max' => 'The short name may not be greater than 255 characters.',
            'short_name.unique' => 'The short name already exists.',
        ];
    }

    }
