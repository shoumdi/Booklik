<?php

use App\Providers\AppServiceProvider;
use JWT\JwtGuardServiceProvider;

return [
    AppServiceProvider::class,
    JwtGuardServiceProvider::class
];
