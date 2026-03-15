<?php

namespace App\Http\Controllers\Auth;

use App\Dto\Auth\LoginDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Service\Auth\LoginService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Cookie;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $req, LoginService $login)
    {
        $tokens = $login->execute(LoginDto::fromArray($req->validated()));
        return response()->json(
            data: [
                'success' => true,
                'data' => [
                    'jat' => $tokens['jat']
                ]
            ],
            status: 201
        )->cookie(new Cookie(
            name: 'jrt',
            value: $tokens['jrt'],
            expire: time() + env('JWT_REFRESH_TTL', 8400),
            httpOnly: true,
            secure: false,
            sameSite: Cookie::SAMESITE_NONE
        ));
    }
}
