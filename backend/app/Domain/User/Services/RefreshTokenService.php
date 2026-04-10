<?php

namespace App\Domain\User\Services;

use Exception;
use Illuminate\Support\Facades\Auth;

class RefreshTokenService
{

    public function execute()
    {
        try {
            return Auth::guard()->refreshToken();
        } catch (Exception $e) {
            // To do logg
            throw $e;
        }
    }
}
