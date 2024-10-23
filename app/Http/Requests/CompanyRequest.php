<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'company_size' => 'required|integer',
            'phone_number' => 'required|string|max:255',
            'incorporation_date' => 'required|date',
            'industry' => 'required|string|max:255',
            'website' => 'nullable|url',
        ];
    }


/**
     * Get the custom messages for validation errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name field must be a string.',
            'name.max' => 'The name field cannot be more than 255 characters.',

            'address.required' => 'The address field is required.',
            'address.string' => 'The address field must be a string.',

            'company_size.required' => 'The company size field is required.',
            'company_size.integer' => 'The company size field must be an integer.',

            'phone_number.required' => 'The phone number field is required.',
            'phone_number.string' => 'The phone number field must be a string.',
            'phone_number.max' => 'The phone number field cannot be more than 11 number.',

            'incorporation_date.required' => 'The incorporation date field is required.',
            'incorporation_date.date' => 'The incorporation date field must be a valid date.',

            'industry.required' => 'The industry field is required.',
            'industry.string' => 'The industry field must be a string.',
            'industry.max' => 'The industry field cannot be more than 255 characters.',
            
            'website.url' => 'The website field must be a valid URL.',
        ];
    }
}
