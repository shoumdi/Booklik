<?php

namespace App\Domain\Author\Dto;

class AuthorData
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        readonly string $firstName,
        readonly string $lastName
    ) {}

    public static function from(array $inputs)
    {
        return new self(
            $inputs['fname'],
            $inputs['lname'],
        );
    }
}
