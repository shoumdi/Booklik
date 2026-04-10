<?php

namespace App\Domain\User\Dto;

class RegisterUserData
{

    public function __construct(
        readonly string $fname,
        readonly string $lname,
        readonly string $email,
        readonly string $password,
        readonly string $role
    ) {}

    public static function fromArray(array $inputs)
    {
        return new self(
            fname: $inputs['fname'],
            lname: $inputs['lname'],
            email: $inputs['email'],
            password: $inputs['password'],
            role: $inputs['role']
        );
    }

    public function toArray(): array
    {
        return [
            'fname' => $this->fname,
            'lname' => $this->lname,
            'email' => $this->email,
            'password' => $this->password
        ];
    }
}
