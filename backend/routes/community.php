<?php

use App\Domain\Booking\Http\Controllers\BookingBookController;
use App\Domain\Community\Http\Controllers\CommunityDetailsController;
use App\Domain\Community\Http\Controllers\CreateCommunityController;
use App\Domain\Community\Http\Controllers\FetchCommunitiesController;
use App\Domain\Community\Http\Controllers\UserCommunitiesController;
use App\Domain\Contribute\Http\Controllers\CheckoutContributionController;
use App\Domain\Contribute\Http\Controllers\ContributionWebhookController;
use App\Domain\Suggestion\Http\Controllers\FetchCommunitySuggestionsController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api'])->group(function () {
    Route::post('/communities', CreateCommunityController::class);
    Route::get('/communities/search', FetchCommunitiesController::class);
    Route::get('/communities', [UserCommunitiesController::class, 'index']);
    Route::get('/communities/{id}', [UserCommunitiesController::class, 'show']);
    Route::post('/communities/{communityId}/books/{bookId}', BookingBookController::class);
    Route::post('/communities/{communityId}/invitations', [InvitationController::class, 'store']);
    Route::post('/communities/{communityId}/contributions', CheckoutContributionController::class);
    Route::put('/communities/{communityId}/invitations/{inviteId}/accept', [InvitationController::class, 'accept']);
    Route::put('/communities/{communityId}/invitations/{inviteId}/refuse', [InvitationController::class, 'refuse']);
});
Route::get('/communities/{communityId}/suggestions', FetchCommunitySuggestionsController::class);
Route::get('/communities/{id}', CommunityDetailsController::class);

Route::post('/stripe/webhook', ContributionWebhookController::class);