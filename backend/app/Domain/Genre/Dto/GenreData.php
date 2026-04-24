<?php

namespace App\Domain\Genre\Dto;

class GenreData
{
    public function __construct(
        readonly string $name,
        readonly string $description
    ) {}
    public static function form(array $inputs)
    {
        return new self(
            name: $inputs['name'],
            description: $inputs['description'],
        );
    }
}
