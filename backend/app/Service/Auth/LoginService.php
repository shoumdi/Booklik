<?php

namespace App\Service\Auth;

use App\Dto\Auth\LoginDto;
use App\Models\Role;
use App\Models\User;
use DomainException;
use Exception;
use Illuminate\Support\Facades\Auth;
use JWT\Exception\InvalidCredentialsException;

class LoginService
{

    public function execute(
        LoginDto $dto
    ) {
        try {
            $tokens = Auth::guard()->attempt($dto->toArray());
            return [
                'tokens' => $tokens,
                'user' => User::where('email', $dto->email)->first()
            ];
        } catch (Exception $e) {
            // To do logg
            throw $e;
        }
    }
}
