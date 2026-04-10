<?php

namespace App\Domain\Book\Http\Controllers;

use App\Domain\Book\Http\Responses\BookResponse;
use App\Shared\Http\Controllers\Controller;
use Core\SuccessJsonResponse;

class FetchBooksController extends Controller
{
    public function __invoke()
    {

        return SuccessJsonResponse::make(BookResponse::collection());
    }
}
