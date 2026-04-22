<?php

namespace App\Domain\Book\Http\Controllers;

use App\Domain\Book\Http\Responses\BookResponse;
use App\Domain\Book\Services\FetchBooksService;
use App\Shared\Http\Controllers\Controller;
use Core\SuccessJsonResponse;

class FetchBooksController extends Controller
{
    public function __construct(
        private FetchBooksService $service
    ) {}
    public function __invoke()
    {
        // Gate::authorize('viewAny',Book::class);
        return SuccessJsonResponse::make([
            [
                'title' => "cleanArchitecture",
                'author'=>"Uncle bob",
                'cover'=>'https://edit.org/images/cat/book-covers-big-2019101610.jpg'
            ]
        ]);
        // return SuccessJsonResponse::make(BookResponse::collection($this->service->execute()));
    }
}
