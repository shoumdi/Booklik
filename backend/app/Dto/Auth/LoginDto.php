<?php

namespace App\Dto\Auth;

class LoginDto
{

    public function __construct(
        readonly string $email,
        readonly string $password,
    ) {}

    public static function fromArray(array $inputs)
    {
        return new self(
            email: $inputs['email'],
            password: $inputs['password'],
        );
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password
        ];
    }
}
