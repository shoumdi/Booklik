<?php

use App\Domain\Analytics\Http\Controllers\FetchAnalyticsController;
use App\Domain\Community\Http\Controllers\Admin\CommunityController;
use App\Domain\User\Http\Controllers\FetchUsersController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api'])->group(function () {
    Route::get('/admin/analytics', FetchAnalyticsController::class);
    Route::get('/admin/users',FetchUsersController::class);
    Route::get('/admin/communities',[CommunityController::class,'index']);
    Route::put('/admin/communities/{id}',[CommunityController::class,'update']);
});
