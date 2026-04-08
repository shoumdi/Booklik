<?php

namespace App\Http\Controllers\Auth;

use App\Dto\Auth\UserDto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class AuthenticatedUserController extends Controller
{
    public function __invoke(Request $req)
    {
        return response()->json(
            data: [
                'success' => true,
                'data' => ['user' => UserDto::fromUser($req->user())]
            ],
            status: 200
        );
    }
}
