<?php

namespace App\Domain\Suggestion\Http\Responses;

use Core\Ressource;

class SuggestionResponse extends Ressource
{
    
    protected function toArray(): array
    {
        return [
            'id'=>$this->model->id,
            'book_title'=>$this->model->book->title,
            'estimated_price'=>$this->model->book->estimated_price,
            'status'=>$this->model->status,
            'votes'=>$this->model->votes()->count()
        ];
    }
}
