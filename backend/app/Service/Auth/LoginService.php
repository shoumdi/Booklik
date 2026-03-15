<?php

namespace App\Service\Auth;

use App\Dto\Auth\LoginDto;
use App\Models\User;
use DomainException;
use Illuminate\Support\Facades\Auth;

class LoginService
{

    public function execute(
        LoginDto $dto
    ) {
        try {
            return Auth::guard()->attempt($dto->toArray());
        } catch (DomainException $e) {
            // To do logg
            throw $e;
        }
    }
}
