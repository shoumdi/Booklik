<?php

namespace App\Domain\Vote\Services;

use App\Domain\Suggestion\Models\Suggestion;
use Illuminate\Support\Facades\Auth;

class ToggleVoteService
{
    public function execute(int $suggestionId)
    {
        $votes = Suggestion::findOrFail($suggestionId)->votes();
        if (!($vote = $votes->where('created_by', Auth::guard()->id())->first())) {
            return $votes->create()->load('suggestion');
        }
        $vote->toggleVote();
        return $vote->load('suggestion');
    }
}
