<?php

namespace App\Domain\Vote\Http\Controllers;

use App\Domain\Vote\Http\Requests\ToggelVoteRquest;
use App\Domain\Vote\Http\Responses\VoteResponse;
use App\Domain\Vote\Models\Vote;
use App\Domain\Vote\Services\ToggleVoteService;
use App\Shared\Http\Controllers\Controller;
use Core\SuccessJsonResponse;
use Illuminate\Support\Facades\Gate;

class ToggleVoteController extends Controller
{
    public function __construct(
        private ToggleVoteService $service
    ) {}
    public function __invoke(ToggelVoteRquest $req)
    {
        $validated = $req->validated();
        Gate::authorize('create', [Vote::class, $validated['suggestion_id']]);
        $submitted = $this->service->execute($validated['suggestion_id']);
        return SuccessJsonResponse::make((new VoteResponse($submitted))->build(), 201);
    }
}
