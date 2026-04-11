<?php

use App\Domain\Book\Http\Controllers\CreateBookController;
use App\Domain\Community\Http\Controllers\CommunityDetailsController;
use App\Domain\Community\Http\Controllers\CreateCommunityController;
use App\Domain\Genre\Http\Controllers\CreateGenreController;
use App\Domain\Genre\Http\Controllers\FetchGenresController;
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
    Route::post('/communities', CreateCommunityController::class);
    Route::get('/communities',FetchCommunitiesControlle::class);
    Route::post('/genres',CreateGenreController::class);
    Route::get('/genres',FetchGenresController::class);
    Route::post('/books',CreateBookController::class);
    });
Route::get('/communities/{id}',CommunityDetailsController::class);


Route::post('/books/suggestions',CreateBookController::class);

