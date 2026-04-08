<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Responses\LoginResponse;
use App\Service\Auth\RefreshTokenService;
use Core\SuccessJsonResponse;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Cookie;

class RefreshTokenControler extends Controller
{
    public function __invoke(
        RefreshTokenService $service
    )
    {
        $res = $service->execute();
        return SuccessJsonResponse::make(
            data: ['jat'=>$res['jat']],
            status: 200
        )->cookie(new Cookie(
            name: 'jrt',
            value: $res['jrt'],
            expire: time() + env('JWT_REFRESH_TTL', 8400),
            httpOnly: true,
            secure: false,
            sameSite: Cookie::SAMESITE_LAX
        ));
    }
}
