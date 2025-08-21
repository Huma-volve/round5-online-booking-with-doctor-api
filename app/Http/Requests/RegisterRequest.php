<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'type' => 'nullable|string|in:admin,doctor,customer'
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array {
        return [
            'name.required' => 'Name is required',
            'name.string' => 'Name must be text',
            'name.max' => 'Name must not exceed 255 characters',

            'email.required' => 'Email is required',
            'email.email' => 'Email must be valid',
            'email.unique' => 'Email is already in use',

            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',
            'password.confirmed' => 'Password confirmation does not match',

            'phone.string' => 'Phone number must be text',
            'phone.max' => 'Phone number must not exceed 20 characters',
        ];
    }
}
