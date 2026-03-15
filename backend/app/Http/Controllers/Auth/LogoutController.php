<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use JWT\JWT;

class LogoutController extends Controller
{
    public function __invoke(Request $request)
    {
        $payload = (new JWT())->decode($request->cookie('jrt'),env('JWT_SECRET'));
        Auth::guard()->logout();
        return response()->json(
            data: 'loged out successfully',
            status: 200
        );
    }
}
