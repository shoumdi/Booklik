<?php

use App\Domain\Community\Http\Controllers\CommunityDetailsController;
use App\Domain\Community\Http\Controllers\CreateCommunityController;
use App\Domain\Community\Http\Controllers\FetchCommunitiesController;
use App\Domain\Suggestion\Http\Controllers\CreateSuggestionController;
use App\Domain\Suggestion\Http\Controllers\FetchCommunitySuggestionsController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api'])->group(function () {
    Route::post('/communities', CreateCommunityController::class);
    Route::get('/communities', FetchCommunitiesController::class);
});
Route::get('/communities/{communityId}/suggestions', FetchCommunitySuggestionsController::class);
Route::get('/communities/{id}', CommunityDetailsController::class);
