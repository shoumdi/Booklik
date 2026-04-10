<?php

namespace App\Domain\User\Http\Controllers;

use App\Domain\User\Dto\LoginData;
use App\Domain\User\Http\Requests\LoginRequest;
use App\Domain\User\Http\Responses\AuthenticatedResponse;
use App\Domain\User\Http\Responses\LoginResponse;
use App\Domain\User\Services\LoginService;
use App\Shared\Http\Controllers\Controller;
use Core\SuccessJsonResponse;
use Symfony\Component\HttpFoundation\Cookie;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $req, LoginService $login)
    {
        $res = $login->execute(LoginData::fromArray($req->validated()));
        return SuccessJsonResponse::make(
            data: LoginResponse::make($res['tokens']['jat'],new AuthenticatedResponse($res['user'])),
            status: 201
        )->cookie(new Cookie(
            name: 'jrt',
            value: $res['tokens']['jrt'],
            expire: time() + env('JWT_REFRESH_TTL', 8400),
            httpOnly: true,
            secure: false,
            sameSite: Cookie::SAMESITE_LAX
        ));
    }
}
