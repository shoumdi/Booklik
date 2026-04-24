<?php

namespace App\Domain\Genre\Policies;

use App\Domain\Genre\Models\Genre;
use App\Domain\User\Models\User;
use Core\AppRole;
use Illuminate\Auth\Access\Response;

class GenrePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Genre $genre): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->roles()->get(['name'])->contains('name', AppRole::SUPER_ADMIN->value)
            ? Response::allow()
            : Response::denyWithStatus(403, 'onlyauthorized users can create genres');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Genre $genre): Response
    {
        return $user->roles()->get(['name'])->contains('name', AppRole::SUPER_ADMIN->value)
            ? Response::allow()
            : Response::denyWithStatus(403, 'onlyauthorized users can update genres');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Genre $genre): Response
    {
        return $user->roles()->get(['name'])->contains('name', AppRole::SUPER_ADMIN->value)
            ? Response::allow()
            : Response::denyWithStatus(403, 'onlyauthorized users can update genres');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Genre $genre): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Genre $genre): bool
    {
        return false;
    }
}
