<?php

namespace App\Domain\User\Http\Controllers;

use App\Domain\User\Http\Responses\AdminUsersList;
use App\Domain\User\Models\User;
use App\Shared\Http\Controllers\Controller;
use Core\SuccessJsonResponse;

class FetchUsersController extends Controller
{
    public function __invoke() {
        return SuccessJsonResponse::make(AdminUsersList::collection(User::all()));
    }
}
