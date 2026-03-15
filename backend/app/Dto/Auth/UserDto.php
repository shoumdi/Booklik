<?php

namespace App\Dto\Auth;

use App\Models\User;

class UserDto
{

    public function __construct(
        readonly string $fullname,
        readonly string $email,
    ) {}

    public static function fromUser(User $user)
    {
        return new self(
            fullname: $user->fname . ' ' . $user->lname,
            email: $user->email
        );
    }
}
