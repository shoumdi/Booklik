<?php

use App\Domain\Book\Http\Controllers\CreateBookController;
use App\Domain\Community\Http\Controllers\CommunityDetailsController;
use App\Domain\Community\Http\Controllers\CommunityIndexController;
use App\Domain\Community\Http\Controllers\CreateCommunityController;
use App\Domain\User\Http\Controllers\AuthenticatedUserController;
use App\Domain\User\Http\Controllers\LoginController;
use App\Domain\User\Http\Controllers\LogoutController;
use App\Domain\User\Http\Controllers\RefreshTokenControler;
use App\Domain\User\Http\Controllers\RegisterUserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

Route::post('/register', RegisterUserController::class);
Route::post('/login', LoginController::class);
Route::post('/refreshtoken', RefreshTokenControler::class);
Route::middleware(['auth:api'])->group(function () {
    Route::get('/me', AuthenticatedUserController::class);
    Route::get('/logout', LogoutController::class);
    Route::post('/communities', CreateCommunityController::class);
    Route::get('/communities',CommunityIndexController::class);
    });
Route::get('/communities/{id}',CommunityDetailsController::class);


Route::post('/books/suggestions',CreateBookController::class);

Route::delete('/delete', function () {
    return response()->json(
        User::query()->delete(),
        200
    );
});

Route::post('/redis', function (Request $req) {
    $input = $req->input('name');
    return response()->json(
        Cache::add("blacklist:$input", $input, 120),
        200
    );
});

Route::get('/redis', function () {
    return response()->json(
        Cache::get("blacklist:salah@gmail.com/LNgC6YCXyxMACwokSG3YDDtkIWbYVfM1", 'empty'),
        200
    );
});
