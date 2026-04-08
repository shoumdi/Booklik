<?php

namespace App\Service\Auth;

use App\Dto\Auth\RegisterUserDto;
use App\Models\Role;
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
