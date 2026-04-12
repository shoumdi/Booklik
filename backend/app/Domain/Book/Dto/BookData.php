<?php

namespace App\Domain\Book\Dto;

class BookData
{
    public function __construct(
        readonly string $title,
        readonly string $description,
        readonly float $estimatedPrice,
        readonly array $genres,
        readonly array $authors
    ) {}

    public static function from(array $inputs)
    {
        return new self(
            $inputs['title'],
            $inputs['description'],
            $inputs['estimated_price'],
            $inputs['genres'],
            array_map(fn($a) => new AuthorData($a['fname'], $a['lname']), $inputs['authors'])
        );
    }
}
