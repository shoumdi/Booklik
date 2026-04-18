<?php

namespace App\Domain\Vote\Policies;

use App\Domain\Suggestion\Models\Suggestion;
use App\Domain\User\Models\User;
use App\Domain\Vote\Models\Vote;
use Core\Strings;
use Illuminate\Auth\Access\Response;

class VotePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Vote $vote): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, int $suggestionId): Response
    {
        return (
            Suggestion::whereKey($suggestionId)
            ->whereHas('community.users', function ($q) use ($user) {
                $q->where('users.id', $user->id);
            })
            ->exists()
        )
            ? Response::allow()
            : Response::deny(403, Strings::$UNAUTHORIZED_ERROR);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Vote $vote, int $suggestionId): Response
    {
        // I have used nested ternary even if i know it's bad for code clarity
        // I could have used simple if else 
        return ($user->id === $vote->created_by && Suggestion::where($suggestionId)->get(['status'])->status !== 'IMPLEMENTED')
            ? Response::allow()
            : (($user->id !== $vote->created_by)
                ? Response::denyWithStatus(403, Strings::$UNAUTHORIZED_ERROR)
                : Response::denyWithStatus(403, Strings::$UNABLE_TO_UPDATE));
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Vote $vote): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Vote $vote): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Vote $vote): bool
    {
        return false;
    }
}
