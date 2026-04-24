<?php

namespace App\Domain\User\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterUserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fname' => ['required', 'string', 'min:1', 'max:50'],
            'lname' => ['required', 'string', 'min:1', 'max:50'],
            'email' => ['required', 'email'],
            'password' => [
                'required',
                'string',
                'regex:/[A-Z]/',
                Password::min(8)
                    ->letters()
                    ->numbers()
            ]
        ];
    }

    public function messages()
    {
        return [
            'fname.required' => 'first name is mandatory',
            'fname.min' => 'first name should at least have one character',
            'fname.max' => 'first name should at most have 50 characters',

            'lname.required' => 'last name is mandatory',
            'lname.min' => 'last name should at least have one character',
            'lname.max' => 'last name should at most have 50 characters',

            'password.min' => 'password has to be at lease 8 characters',
            'password.letters' => 'password should include at least one letter',
            'password.numbers' => 'password should include at least one number',
            'password.regex' => 'password should include at least one uppercase'

        ];
    }
}
