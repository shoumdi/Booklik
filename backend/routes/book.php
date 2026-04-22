<?php

use App\Domain\Book\Http\Controllers\CreateBookController;
use App\Domain\Book\Http\Controllers\FetchBooksController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api'])->group(function () {
    Route::post("/books", CreateBookController::class);
});
Route::get("/books", FetchBooksController::class);
