<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees',
            'phone' => 'required|string|max:255|unique:employees',
            'address' => 'required|string|max:255',  
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',    
        ];
    }
    public function messages()
    {
        return [
            'firstName.required' => 'First Name is required',
            'lastName.required' => 'Last Name is required',
            'email.required' => 'Email is required',
            'email.unique' => 'Email is already taken',
            'email.email' => 'Email is invalid',
            'email.max' => 'Email is too long',
            'phone.required' => 'Phone is required',
            'phone.unique' => 'Phone is already taken',
            'phone.max' => 'Phone is too long',
            'address.required' => 'Address is required',
            'address.max' => 'Address is too long',
            'image.image' => 'Image is invalid',
            'image.mimes' => 'Image format is invalid',
            'image.max' => 'Image size is too large',
            ];
    }
}
