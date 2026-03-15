<?php

use App\Http\Controllers\Auth\AuthenticatedUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RefreshTokenControoler;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

Route::post('/register', RegisterUserController::class);
Route::post('/login', LoginController::class);
Route::get('/refreshtoken', RefreshTokenControoler::class);
Route::middleware(['auth:api'])->group(function(){
    Route::get('/me', AuthenticatedUserController::class);
    Route::get('/logout', LogoutController::class);
});
Route::delete('/delete', function () {
    return response()->json(
        User::query()->delete(),
        200
    );
});

Route::post('/redis',function(Request $req){
    $input = $req->input('name');
    return response()->json(
        Cache::add("blacklist:$input",$input,120),
        200
    );
});

Route::get('/redis',function(){
return response()->json(
        Cache::get("blacklist:salah@gmail.com/LNgC6YCXyxMACwokSG3YDDtkIWbYVfM1",'empty'),
        200
    );
});
