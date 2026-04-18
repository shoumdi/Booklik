<?php

namespace App\Domain\Book\Services;

use App\Domain\Author\Models\Author;
use App\Domain\Book\Dto\BookData;
use App\Domain\Book\Models\Book;
use App\Domain\Genre\Models\Genre;
use Illuminate\Support\Facades\DB;

class CreateBookService
{
    public function execute(BookData $data)
    {
        $created = DB::transaction(function () use ($data) {
            $genreIds = Genre::whereIn('name', $data->genres)->get('id')->map(fn($g) => $g->id)->toArray();
            $authorsIds = array_map(
                function ($author) {
                    return Author::firstOrCreate(
                        ['fname' => $author->firstName, 'lname' => $author->lastName],
                        ['fname' => $author->firstName, 'lname' => $author->lastName]
                    )->id;
                },
                $data->authors
            );
            $created = Book::create([
                'title' => $data->title,
                'estimated_price' => $data->estimatedPrice,
                'description' => $data->description,
                'edition' => '1'
            ]);
            $created->genres()->syncWithoutDetaching($genreIds);
            $created->authors()->syncWithoutDetaching($authorsIds);
            return $created;
        });

        return $created;
    }
}
