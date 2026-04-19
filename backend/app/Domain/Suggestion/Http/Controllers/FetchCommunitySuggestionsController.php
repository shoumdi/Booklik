<?php

namespace App\Domain\Suggestion\Http\Controllers;

use App\Domain\Community\Models\Community;
use App\Domain\Suggestion\Http\Responses\SuggestionResponse;
use App\Shared\Http\Controllers\Controller;
use Core\SuccessJsonResponse;

class FetchCommunitySuggestionsController extends Controller
{
    public function __construct(
    ) {}
    public function __invoke(int $commynityId)
    {
        $suggestions = Community::findOrFail($commynityId)->suggestions()->get();
        return SuccessJsonResponse::make(
            data: SuggestionResponse::collection($suggestions),
            status: 200,
            message: 'suggestion fetched successfully'
        );
    }
}
