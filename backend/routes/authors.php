<?php

use App\Domain\Author\Http\Controllers\CreateAuthorController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api'])->group(function () {
    Route::post("/authors", CreateAuthorController::class);
});