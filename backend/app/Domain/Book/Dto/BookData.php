<?php

namespace App\Domain\Book\Dto;

use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;

class BookData
{
    public function __construct(
        readonly ?int $id,
        readonly string $title,
        readonly string $description,
        readonly ?UploadedFile $cover,
        readonly float $estimatedPrice,
        readonly array $genres,
        readonly array $authors
    ) {}

    public static function from(array $inputs)
    {
        return new self(
            $inputs['book_id'] ?? null,
            $inputs['book_title'],
            $inputs['book_description'],
            $inputs['book_cover'] ?? null,
            $inputs['book_price'],
            $inputs['book_genres'],
            array_map(fn($a) => new AuthorData($a['fname'], $a['lname']), $inputs['book_authors'])
        );
    }
}
