<?php

namespace App\Domain\Book\Http\Controllers;

use App\Domain\Book\Dto\BookData;
use App\Domain\Book\Http\Requests\CreateBookRequest;
use App\Domain\Book\Http\Responses\BookResponse;
use App\Domain\Book\Services\CreateBookService;
use App\Shared\Http\Controllers\Controller;
use Core\SuccessJsonResponse;

class CreateBookController extends Controller
{
    public function __construct(
        private CreateBookService $service
    ) {}
    public function __invoke(CreateBookRequest $req)
    {
        $saved = $this->service->execute(BookData::from($req->validated()));
        return SuccessJsonResponse::make((new BookResponse($saved))->build());
    }
}
