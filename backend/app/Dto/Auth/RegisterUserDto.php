<?php

namespace App\Dto\Auth;

class RegisterUserDto
{

    public function __construct(
        readonly string $fname,
        readonly string $lname,
        readonly string $email,
        readonly string $password,
    ) {}

    public static function fromArray(array $inputs){
        return new self(
            fname:$inputs['fname'],
            lname:$inputs['lname'],
            email:$inputs['email'],
            password:$inputs['password'],
        );
    }

    public function toArray():array{
        return [
            'fname'=>$this->fname,
            'lname'=>$this->lname,
            'email'=>$this->email,
            'password'=>$this->password
        ];
    }
}
