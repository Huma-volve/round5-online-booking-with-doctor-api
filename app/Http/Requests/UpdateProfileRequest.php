<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'name' => 'sometimes|string|max:255',
            'phone' => 'sometimes|string|max:20',
            'birthdate' => 'sometimes|date|before:today',
            'avatar' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.string' => 'Name must be text',
            'name.max' => 'Name must not exceed 255 characters',

            'phone.string' => 'Phone number must be text',
            'phone.max' => 'Phone number must not exceed 20 characters',

            'birthdate.date' => 'Birthdate must be a valid date',
            'birthdate.before' => 'Birthdate must be before today',
            
            'avatar.image' => 'Avatar must be an image file',
            'avatar.mimes' => 'Avatar must be a file of type: jpeg, png, jpg, gif',
            'avatar.max' => 'Avatar may not be greater than 2MB',
        ];
    }
} 