<?php

use App\Domain\Analytics\Http\Controllers\FetchAnalyticsController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api'])->group(function () {
    Route::get('/admin/analytics', FetchAnalyticsController::class);
});
