<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegistrationRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'email', 'unique:users,email'],
            'phone' => ['required', 'string'],
            'password' => ['required', 'min:8', 'max:15', Password::min(8)->mixedCase()->numbers()->symbols()],

        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'Email already exists',
            'phone_number.unique' => 'Phone number already exists',
            'password' => 'Password must be at least 8 characters long and must contain at least one uppercase letter, one lowercase letter, one number and one special character',
            'first_name.required' => 'First name is required',
            'last_name.required' => 'Last name is required',
            'phone_number.required' => 'Phone number is required',
            'password.required' => 'Password is required',
            'email.required' => 'Email is required',
            'first_name.max' => 'First name must not be more than 255 characters',
            'last_name.max' => 'Last name must not be more than 255 characters',
            'phone_number.max' => 'Phone number must not be more than 255 characters',
            'password.min' => 'Password must be at least 8 characters long',
            'email.email' => 'A valid email is required'

        ];
    }
}
