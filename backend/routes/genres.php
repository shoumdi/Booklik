<?php


use App\Domain\Genre\Http\Controllers\GenresController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api'])->group(function () {
    Route::post('/genres', [GenresController::class, 'store']);
    Route::delete('/genres/{id}', [GenresController::class, 'destroy']);
});
Route::get('/genres', [GenresController::class, 'index']);
