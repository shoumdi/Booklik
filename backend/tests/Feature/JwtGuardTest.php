<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use JWT\Exception\InvalidCredentialsException;
use Tests\TestCase;

class JwtGuardTest extends TestCase
{
    use RefreshDatabase;

    function test_invalid_credentials()
    {
        $this->expectException(InvalidCredentialsException::class);
        Auth::guard()->validate([
            'email' => 'email@email.com',
            'password' => 'random'
        ]);
    }

    public function test_user_not_authenticated()
    {
        $this->assertFalse(Auth::guard()->check());
        // $this->assertEquals(1,3,"mkitsawawch");
    }

    
}
