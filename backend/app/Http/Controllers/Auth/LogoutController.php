<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class LogoutController extends Controller
{
    public function __invoke()
    {
        Auth::guard()->logout();
        return response()->json(
            data: 'loged out successfully',
            status: 200
        )->cookie(
            Cookie::forget('jrt')
        );
    }
}
