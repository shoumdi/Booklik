<?php

namespace App\Http\Controllers\Auth;

use App\Dto\Auth\RegisterUserDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Http\Responses\LoginResponse;
use App\Service\Auth\RegisterUserService;
use Core\SuccessJsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Cookie;

class RegisterUserController extends Controller
{
    public function __invoke(RegisterUserRequest $req, RegisterUserService $register)
    {
        $inputs = $req->validated();
        $inputs['role'] = 'User';
        $res = $register->execute(RegisterUserDto::fromArray($inputs));

        return SuccessJsonResponse::make(
            data: LoginResponse::make($res),
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
