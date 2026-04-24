<?php

use App\Domain\Contribute\Http\Controllers\ContributionWebhookController;
use App\Domain\Contribute\Http\Controllers\MakeContributionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api'])->group(function () {
    Route::post('/communities/{communityId}/contributions', MakeContributionController::class);
    Route::get('/stripe/webhook', ContributionWebhookController::class);
});
