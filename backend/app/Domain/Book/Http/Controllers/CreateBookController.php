<?php

namespace App\Domain\Book\Http\Controllers;

use App\Domain\Book\Dto\BookData;
use App\Domain\Book\Http\Requests\CreateBookRequest;
use App\Domain\Book\Http\Responses\BookResponse;
use App\Domain\Book\Models\Book;
use App\Domain\Book\Services\CreateBookService;
use App\Shared\Http\Controllers\Controller;
use Core\SuccessJsonResponse;
use Illuminate\Support\Facades\Gate;

class CreateBookController extends Controller
{
    public function __construct(
        private CreateBookService $service
    ) {}

    public function __invoke(CreateBookRequest $req)
    {
        Gate::authorize('create', Book::class);
        $saved = $this->service->execute(BookData::from($req->validated()));
        return SuccessJsonResponse::make((new BookResponse($saved))->build());
    }
}
