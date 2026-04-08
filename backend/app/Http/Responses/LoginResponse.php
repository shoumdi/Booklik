<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Collection;

class LoginResponse
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        readonly string $jat,
        readonly array $user,
    ) {}

    public static function make(array $resp): self
    {
        return new self(
            jat: $resp['tokens']['jat'],
            user: [
                'fullname' => $resp['user']->fname . ' ' . $resp['user']->lname,
                'email' => $resp['user']->email,
                'role' => array_map(function ($role) {
                    return $role['name'];
                }, $resp['user']->roles()->get()->toArray())
            ],
        );
    }
}
