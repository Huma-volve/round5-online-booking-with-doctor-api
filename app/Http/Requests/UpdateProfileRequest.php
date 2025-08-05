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
        ];
    }
} 