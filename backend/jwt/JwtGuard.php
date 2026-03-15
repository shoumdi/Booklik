<?php

namespace JWT;

use DomainException;
use Exception;
use JWT\Interfaces\JwtGuardInterface;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use JWT\Exception\ExpiredTokenException;
use JWT\Exception\InvalidCredentialsException;
use JWT\Exception\RequiredTokenException;

use function PHPUnit\Framework\isNull;

class JwtGuard implements JwtGuardInterface
{
    private ?Authenticatable $user = null;
    public function __construct(
        private UserProvider $userProvider,
        private Request $request,
        private JWT $jwt
    ) {}

    public function attempt(array $credentials): ?array
    {
        $user = $this->userProvider->retrieveByCredentials($credentials);
        if (!$user) return null;
        return $this->generateTokens($user);
    }
    public function login(Authenticatable $user): array
    {
        return $this->generateTokens($user);
    }

    private function generateTokens(Authenticatable $user): array
    {
        return [
            'jat' => $this->jwt->encode(
                payload: [
                    'jti' => "$user->email" . '/' . Str::random(32),
                    'iat' => time(),
                    'exp' => time() + env('JWT_TTL', 1800),
                    'sub' => $user->id
                ],
                secret: env('JWT_SECRET', 'Bearer'),
                alg: env('JWT_ALG', 'HS256')
            ),
            'jrt' => $this->jwt->encode(
                payload: [
                    'jti' => "$user->email" . '/jrt/' . Str::random(32),
                    'iat' => time(),
                    'exp' => time() + env('JWT_REFRESH_TTL', 86400),
                    'sub' => $user->id
                ],
                secret: env('JWT_SECRET', 'Bearer'),
                alg: env('JWT_ALG', 'HS256')
            )
        ];
    }
    public function refreshToken(): ?string
    {
        if (!$token = $this->request->cookie('jrt'))
            throw new RequiredTokenException('refresh token not found');
        $payload = $this->jwt->decode($token, env('JWT_SECRET', 'Bearer'));
        if (Cache::has("blacklist:$payload->jti"))
            throw new ExpiredTokenException('expired refresh token');
        $user = $this->userProvider->retrieveById($payload->sub);
        return $this->jwt->encode(
            payload: [
                'jti' => "$user->email" . '/' . Str::random(32),
                'iat' => time(),
                'exp' => time() + env('JWT_TTL', 1800),
                'sub' => $user->id
            ],
            secret: env('JWT_SECRET', 'Bearer'),
            alg: env('JWT_ALG', 'HS256')
        );
    }
    public function logout()
    {
        if (!$token = $this->request->bearerToken())
            throw new RequiredTokenException('token not found');
        $payload = $this->jwt->decode($token, env('JWT_SECRET', 'Bearer'));
        Cache::add("blacklist:$payload->jti", $payload->jti, $payload->exp ?? env('JWT_TTL', 1800));
        if (!$token = $this->request->cookie('jrt'))
            throw new RequiredTokenException('refresh token not found');
        $payload = $this->jwt->decode($token, env('JWT_SECRET', 'Bearer'));
        Cache::add("blacklist:$payload->jti", $payload->jti, $payload->exp ?? env('JWT_REFRESH_TTL', 8400));
    }
    public function user()
    {
        if ($this->user) return $this->user;
        if (null === ($token = $this->request->bearerToken())) return null;
        $payload = $this->jwt->decode($token, env('JWT_SECRET', 'Bearer'));
        if (Cache::has("blacklist:$payload->jti")) return $this->user = null;
        $user = $this->userProvider->retrieveById($payload->sub);
        return $this->user = $user;;
    }
    public function check()
    {
        return !is_null($this->user());
    }
    public function guest()
    {
        return !$this->check();
    }
    public function id()
    {
        $this->user->id ?? null;
    }
    public function hasUser()
    {
        return $this->user !== null;
    }
    public function setUser(Authenticatable $user)
    {
        $this->user = $user;
    }
    /**
     * 
     */
    public function validate(array $credentials = [])
    {
        $columns = Schema::getColumnListing('users');
        $common = array_intersect_key($credentials, $columns);
        if (count($common) > count($credentials));
        throw new InvalidCredentialsException('invalide credentials are provided');
        return true;
    }
}
