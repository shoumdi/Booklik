<?php

use App\Domain\User\Http\Controllers\AuthenticatedUserController;
use App\Domain\User\Http\Controllers\LoginController;
use App\Domain\User\Http\Controllers\LogoutController;
use App\Domain\User\Http\Controllers\RefreshTokenControler;
use App\Domain\User\Http\Controllers\RegisterUserController;
use Illuminate\Support\Facades\Route;

Route::post('/register', RegisterUserController::class);
Route::post('/login', LoginController::class);
Route::post('/refreshtoken', RefreshTokenControler::class);
Route::middleware(['auth:api'])->group(function () {
    Route::get('/me', AuthenticatedUserController::class);
    Route::get('/logout', LogoutController::class);
});