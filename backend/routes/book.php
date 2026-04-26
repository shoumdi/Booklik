<?php

use App\Domain\Book\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api'])->group(function () {
    Route::post("/books", [BookController::class, 'store']);
    Route::delete("/books/{id}", [BookController::class, 'destroy']);
    Route::put("/books/{id}", [BookController::class, 'update']);
});
Route::get("/books/{id}", [BookController::class, 'show']);
Route::get("/books", [BookController::class, 'index']);
