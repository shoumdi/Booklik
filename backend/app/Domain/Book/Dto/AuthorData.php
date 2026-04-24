<?php

namespace App\Domain\Book\Dto;

class AuthorData
{
    public function __construct(
        readonly string $firstName,
        readonly string $lastName
    ) {}
}
