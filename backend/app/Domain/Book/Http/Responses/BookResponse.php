<?php

namespace App\Domain\Book\Http\Responses;

use Core\Ressource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class BookResponse extends Ressource
{

    protected function toArray(): array
    {
        return [
            'book_id' => $this->model->id,
            'book_title' => $this->model->title,
            'book_cover' => $this->model->cover()->first()->url,
            'book_description' => $this->model->description,
            'book_price' => $this->model->estimated_price,
            'book_genres' => $this->model->genres()->get()->map(fn($g) => $g->name),
            'book_authors' => $this->model->authors()->get()->map(fn($a) => ['fname' => $a->fname, 'lname' => $a->lname]),
        ];
    }
}
