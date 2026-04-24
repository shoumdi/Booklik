<?php

use App\Domain\Genre\Http\Controllers\CreateGenreController;
use App\Domain\Genre\Http\Controllers\FetchGenresController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api'])->group(function () {
    Route::post('/genres', CreateGenreController::class);
    Route::get('/genres', FetchGenresController::class);
});
