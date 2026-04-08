<?php

namespace JWT\Interfaces;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;

interface JwtGuardInterface extends Guard
{

    /**
     * 
     */
    public function attempt(array $credentials): array;

    /**
     * 
     */
    public function login(Authenticatable $user): array;

    public function refreshToken():?array;

    /**
     * 
     * invalidate authenticated user tokens
     * @throws RequiredTokenException 
     * @throws RequiredTokenException 
     * @throws UnexpectedValueException
     * @throws DomainException
     * @throws InvalidArgumentException
     * @throws InvalidTokenException
     * @throws ExpiredTokenException
     * 
     */
    public function logout();
}
