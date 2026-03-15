<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RefreshTokenControoler extends Controller
{
    public function __invoke()
    {
        $token = auth()->guard()->refreshToken();
        return response()->json(
            data: $token,
            status: 200
        );
    }
}
