<?php

namespace App\Domain\User\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class LoginRequest extends FormRequest
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
            'email' => ['required', 'email', 'exists:users,email'],
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
            'password.min' => 'password has to be at lease 8 characters',
            'password.letters' => 'password should include at least one letter',
            'password.numbers' => 'password should include at least one number',
            'password.regex' => 'password should include at least one uppercase'

        ];
    }
}
