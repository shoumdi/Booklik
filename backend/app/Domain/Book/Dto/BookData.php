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
            $inputs['book_title'],
            $inputs['book_description'],
            $inputs['book_price'],
            $inputs['book_genres'],
            array_map(fn($a) => new AuthorData($a['fname'], $a['lname']), $inputs['book_authors'])
        );
    }
}
