<?php 
namespace App\Domain\Book\Services;

use App\Domain\Book\Models\Book;

class FetchBooksService {
    public function execute(){
        return Book::all();
    }
}