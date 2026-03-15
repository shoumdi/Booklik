<?php

namespace App\Http\Controllers\Auth;

use App\Dto\Auth\RegisterUserDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Service\Auth\RegisterUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Cookie;

class RegisterUserController extends Controller
{
    public function __invoke(RegisterUserRequest $req, RegisterUserService $register)
    {
        $tokens = $register->execute(RegisterUserDto::fromArray($req->validated()));

        return response()->json(
            data: [
                'status' => true,
                'data' => [
                    'jat' => $tokens['jat']
                ]
            ],
            status: 201
        )->cookie(new Cookie(
            name: 'jrt',
            value: $tokens['jrt'],
            expire: env('JWT_REFRESH_TTL', 8400),
            httpOnly: true,
            sameSite: Cookie::SAMESITE_NONE
        ));
    }
}
