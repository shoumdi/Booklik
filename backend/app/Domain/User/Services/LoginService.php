<?php

namespace App\Domain\User\Services;

use App\Domain\User\Dto\LoginData;
use App\Domain\User\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;

class LoginService
{

    public function execute(
        LoginData $dto
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
