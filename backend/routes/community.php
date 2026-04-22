<?php

use App\Domain\Booking\Http\Controllers\BookingBookController;
use App\Domain\Community\Http\Controllers\CommunityDetailsController;
use App\Domain\Community\Http\Controllers\CreateCommunityController;
use App\Domain\Community\Http\Controllers\FetchCommunitiesController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api'])->group(function () {
    Route::post('/communities', CreateCommunityController::class);
    Route::get('/communities', FetchCommunitiesController::class);
    Route::post('/communities/{communityId}/books/{bookId}', BookingBookController::class);
});
Route::get('/communities/{id}', CommunityDetailsController::class);
