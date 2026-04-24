<?php

use App\Domain\Suggestion\Http\Controllers\CreateSuggestionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api'])->group(function () {
    Route::post('/suggestions', CreateSuggestionController::class);
});
