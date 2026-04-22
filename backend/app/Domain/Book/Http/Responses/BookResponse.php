<?php
namespace App\Domain\Book\Http\Responses;

use Core\Ressource;

class BookResponse extends Ressource{
    
    protected function toArray(): array
    {
        return [
            'title'=>'book1',
        ];
    }
}