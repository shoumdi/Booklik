<?php

namespace App\Domain\Book\Services;

use App\Domain\Book\Dto\BookData;
use App\Domain\Book\Models\Author;
use App\Domain\Book\Models\Book;
use App\Domain\Genre\Models\Genre;
use Illuminate\Support\Facades\DB;

class CreateBookService
{
    public function execute(BookData $data)
    {
        $created = DB::transaction(function () use ($data) {
            $genre = Genre::whereIn('name', $data->genres);
            $authorsIds = array_map(
                function ($author) {
                    return Author::firstOrCreate(
                        ['fname' => $author->firstName, 'lname' => $author->lastName],
                        [
                            'fname' => $author->firstName,
                            'lname' => $author->lastName
                        ]
                    )->id;
                },
                $data->authors
            );

            $created = Book::create([
                'title' => $data->title,
                'estimated_price' => $data->estimatedPrice,
                'description' => $data->description
            ]);

            $created->genres()->asyncWithoutDetaching([$genre->id]);
            $created->authors()->asyncWithoutDetaching($authorsIds);
            
            return $created;
        });

        return $created;
    }
}
