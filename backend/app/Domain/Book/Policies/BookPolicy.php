<?php

namespace App\Domain\Book\Policies;

use App\Domain\Book\Models\Book;
use App\Domain\User\Models\User;
use Core\AppRole;
use Core\Strings;
use Illuminate\Auth\Access\Response;

class BookPolicy
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
    public function view(User $user, Book $book): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->roles()->get(['name'])->contains('name','=',AppRole::SUPER_ADMIN->value)
            ? Response::allow()
            : Response::denyWithStatus(403,Strings::$UNAUTHORIZED_ERROR);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Book $book): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Book $book): Response
    {
        return $user->roles()->get(['name'])->contains('name','=',AppRole::SUPER_ADMIN->value)
            ? Response::allow()
            : Response::denyWithStatus(403,Strings::$UNAUTHORIZED_ERROR);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Book $book): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Book $book): bool
    {
        return false;
    }
}
