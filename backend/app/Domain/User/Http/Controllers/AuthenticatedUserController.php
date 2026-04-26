<?php

namespace App\Domain\User\Http\Controllers;

use App\Domain\User\Http\Responses\AuthenticatedResponse;
use App\Shared\Http\Controllers\Controller;
use Core\SuccessJsonResponse;
use Illuminate\Http\Request;
class AuthenticatedUserController extends Controller
{
    public function __invoke(Request $req)
    {
        return SuccessJsonResponse::make((new AuthenticatedResponse($req->user()))->build());
    }
}
