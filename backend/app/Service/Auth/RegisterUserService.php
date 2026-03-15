<?php

namespace App\Service\Auth;

use App\Dto\Auth\RegisterUserDto;
use App\Models\User;
use DomainException;
use Illuminate\Support\Facades\Auth;

class RegisterUserService
{

    public function execute(
        RegisterUserDto $dto
    ) {
        if (User::where('email', $dto->email)->exists()) throw new DomainException('user already exists');
        try {
            $user = User::create($dto->toArray());
            return Auth::guard()->login($user);
        } catch (DomainException $e) {
            // To do logg
            throw $e;
        }
    }
}
