<?php

use App\Domain\Vote\Http\Controllers\ToggleVoteController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api'])->group(function () {
    Route::post('/votes', ToggleVoteController::class);
});