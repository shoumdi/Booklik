<?php

namespace App\Domain\Book\Http\Controllers;

use App\Domain\Book\Http\Responses\BookResponse;
use App\Domain\Book\Models\Book;
use App\Domain\Book\Services\FetchBooksService;
use App\Shared\Http\Controllers\Controller;
use Core\SuccessJsonResponse;
use Illuminate\Support\Facades\Gate;

class FetchBooksController extends Controller
{
    public function __construct(
        private FetchBooksService $service
    ) {}
    public function __invoke()
    {
        Gate::authorize('viewAny',Book::class);
        return SuccessJsonResponse::make(BookResponse::collection($this->service->execute()));
    }
}
