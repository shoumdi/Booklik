<?php

namespace App\Domain\User\Services;

use App\Domain\User\Dto\RegisterUserData;
use App\Domain\User\Models\Role;
use App\Domain\User\Models\User;
use DomainException;
use Illuminate\Support\Facades\Auth;

class RegisterUserService
{

    public function execute(
        RegisterUserData $dto
    ) {
        if (User::where('email', $dto->email)->exists()) throw new DomainException('user already exists');
        try {
            $role = Role::where('name',$dto->role)->first();
            if(!$role) throw new DomainException("role inexistent");
            $user = User::create($dto->toArray());
            $user->roles()->sync([$role->id]);
            return [
                'tokens' => Auth::guard()->login($user),
                'user' => User::where('email', $dto->email)->first()
            ];
        } catch (DomainException $e) {
            // To do logg
            throw $e;
        }
    }
}
