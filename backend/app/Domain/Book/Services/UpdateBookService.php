<?php

namespace App\Domain\Book\Services;

use App\Domain\Author\Models\Author;
use App\Domain\Book\Dto\BookData;
use App\Domain\Book\Models\Book;
use App\Domain\Genre\Models\Genre;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UpdateBookService
{
    public function execute(BookData $data)
    {
        $updated = DB::transaction(function () use ($data) {

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
            $book = Book::findOrFail($data->id);
            $book->update([
                'title'=>$data->title,
                'description'=>$data->description,
                'estimated_price'=>$data->estimatedPrice
            ]);
            $book->genres()->sync($genreIds);
            $book->authors()->sync($authorsIds);
            
            if ($data->cover) {
                $coverUrl = $data->cover->storeAs(
                    "books/{$book->id}/images",
                    Str::slug(pathinfo($data->cover->getClientOriginalName(), PATHINFO_FILENAME)) . '_' . uniqid() . '.' . $data->cover->extension(),
                    "public"
                );
                $book->cover()->create(['url' => Storage::url($coverUrl)]);
            }
            return $book;
        });
        return $updated;
    }
}
