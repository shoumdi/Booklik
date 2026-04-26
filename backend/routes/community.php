<?php

use App\Domain\Booking\Http\Controllers\BookingBookController;
use App\Domain\Community\Http\Controllers\CommunityDetailsController;
use App\Domain\Community\Http\Controllers\CreateCommunityController;
use App\Domain\Community\Http\Controllers\FetchCommunitiesController;
use App\Domain\Invitation\Http\Controllers\InvitationController;
use App\Domain\Suggestion\Http\Controllers\CreateSuggestionController;
use App\Domain\Suggestion\Http\Controllers\FetchCommunitySuggestionsController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api'])->group(function () {
    Route::post('/communities', CreateCommunityController::class);
    Route::get('/communities', FetchCommunitiesController::class);
    Route::post('/communities/{communityId}/books/{bookId}', BookingBookController::class);
    Route::post('/communities/{communityId}/invitations',[InvitationController::class,'store']);
    Route::put('/communities/{communityId}/invitations/{inviteId}/accept',[InvitationController::class,'accept']);
    Route::put('/communities/{communityId}/invitations/{inviteId}/refuse',[InvitationController::class,'refuse']);
});
Route::get('/communities/{communityId}/suggestions', FetchCommunitySuggestionsController::class);
Route::get('/communities/{id}', CommunityDetailsController::class);
