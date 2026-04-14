<?php

namespace App\Domain\Suggestion\Services;

use App\Domain\Book\Models\Book;
use App\Domain\Community\Models\Community;
use App\Domain\Suggestion\Dto\SuggestionData;
use App\Domain\Suggestion\Models\Suggestion;
use Illuminate\Support\Facades\DB;

class CreateSuggestionService
{

    public function execute(SuggestionData $data):Suggestion
    {
        return DB::transaction(function () use ($data) {
            $book = Book::find($data->bookId);
            $created = $book->suggestions()->create();
            $community = Community::find($data->communityId);
            $community->suggestions()->save($created);
            return $created;
        });
    }
}
