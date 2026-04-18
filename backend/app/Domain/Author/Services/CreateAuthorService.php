<?php

namespace App\Domain\Author\Services;

use App\Domain\Author\Dto\AuthorData;
use App\Domain\Author\Models\Author;

class CreateAuthorService
{
    /**
     * Create a new class instance.
     */
    public function execute(AuthorData $authorData)
    {
        $created = Author::create([
            'fname' => $authorData->firstName,
            'lname' => $authorData->lastName,
        ]);
        return $created;
    }
}
