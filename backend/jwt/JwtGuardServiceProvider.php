<?php

namespace JWT;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class JwtGuardServiceProvider extends ServiceProvider
{

    public function register()
    {
        //
    }
    public function boot()
    {
        Auth::extend('jwt', function ($app, $name, array $config) {
            return new JwtGuard(
                userProvider: Auth::createUserProvider($config['provider']),
                request: $app['request'],
                jwt: new JwtProvider()
            );
        });
    }
}
