<?php

namespace App\Domain\User\Http\Controllers;

use App\Domain\User\Dto\RegisterUserData;
use App\Domain\User\Http\Requests\RegisterUserRequest;
use App\Domain\User\Http\Responses\AuthenticatedResponse;
use App\Domain\User\Http\Responses\LoginResponse;
use App\Domain\User\Services\RegisterUserService;
use App\Shared\Http\Controllers\Controller;
use Core\SuccessJsonResponse;
use Symfony\Component\HttpFoundation\Cookie;

class RegisterUserController extends Controller
{
    public function __invoke(RegisterUserRequest $req, RegisterUserService $register)
    {
        $inputs = $req->validated();
        $inputs['role'] = 'User';
        $res = $register->execute(RegisterUserData::fromArray($inputs));

        return SuccessJsonResponse::make(
            data: LoginResponse::make($res['tokens']['jat'],new AuthenticatedResponse($res['user'])),
            status: 201
        )->cookie(new Cookie(
            name: 'jrt',
            value: $res['tokens']['jrt'],
            expire: env('JWT_REFRESH_TTL', 8400),
            httpOnly: true,
            sameSite: Cookie::SAMESITE_NONE
        ));
    }
}
