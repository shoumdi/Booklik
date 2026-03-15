<?php

namespace Tests\Unit;

use DomainException;
use JWT\JWT;
use JWT\Exception\ExpiredTokenException;
use JWT\Exception\InvalidTokenException;
use Tests\TestCase;

class JwtTest extends TestCase
{
    private JWT $jwt;
    
    protected function setUp(): void
    {
        $this->jwt = new JWT();
    }
    public function test_invalid_algo(): void
    {
        $this->expectException(DomainException::class);
        $key = bin2hex(random_bytes(32));
        $this->jwt->encode(
            payload: [
                'iat' => time(),
                'exp' => time() + 120,
                'sub' => 'email@email.com'
            ],
            secret: $key,
            alg: 'some uknown algo'
        );
    }
    public function test_invalid_key()
    {
        $this->expectException(DomainException::class);

        $token = $this->jwt->encode(
            payload: [
                'iat' => time(),
                'exp' => time() + 120,
                'sub' => 'email@email.com'
            ],
            secret: 'sss',
            alg: 'HS256'
        );

        $this->jwt->decode($token, 'sss');
    }

    public function test_invalid_token()
    {
        $this->expectException(InvalidTokenException::class);
        $key = bin2hex(random_bytes(32));

        $token = $this->jwt->encode(
            payload: [
                'iat' => time(),
                'exp' => time() + 120,
                'sub' => 'emai@email.com'
            ],
            secret: $key,
            alg: 'HS256'
        );
        $fakeToken = "eyJ0eXAiOiJqd3QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3NzM0OTY5NTIsImV4cCI6MTc3MzQ5NzA3Miwic3ViIjoiZW1haUBlbWFpbC5jb20ifQ.TubmydYBvCPqBeCzGhv1DLcGUPJoyB_zyY98hYOMW7Y";
        $this->jwt->decode($fakeToken, $key);
    }

    public function test_expired_token()
    {
        $this->expectException(ExpiredTokenException::class);
        $key = bin2hex(random_bytes(32));
        $token = $this->jwt->encode(
            payload: [
                'iat' => time() - 3600,
                'exp' => time() - 3600 + 120,
                'sub' => 'email@email.com'
            ],
            secret: $key,
            alg: 'HS256'
        );
        $this->jwt->decode(
            $token,
            $key
        );
    }
}
