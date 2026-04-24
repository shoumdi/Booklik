<?php

namespace App\Domain\User\Http\Controllers;

use App\Domain\User\Services\RefreshTokenService;
use App\Shared\Http\Controllers\Controller;
use Core\SuccessJsonResponse;
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
