<?php

namespace App\Domain\User\Http\Responses;


class LoginResponse
{

    public static function make(string $jat,AuthenticatedResponse $authenticated): array
    {
        return [
            'jat'=> $jat,
            'user'=> $authenticated->build(),
        ];
    }
}
