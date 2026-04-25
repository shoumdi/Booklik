<?php

namespace App\Domain\Book\Http\Controllers;

use App\Domain\Book\Dto\BookData;
use App\Domain\Book\Http\Requests\CreateBookRequest;
use App\Domain\Book\Http\Requests\UpdateBookRequest;
use App\Domain\Book\Http\Responses\BookResponse;
use App\Domain\Book\Models\Book;
use App\Domain\Book\Services\CreateBookService;
use App\Domain\Book\Services\FetchBooksService;
use App\Domain\Book\Services\UpdateBookService;
use App\Shared\Http\Controllers\Controller;
use Core\SuccessJsonResponse;
use Illuminate\Support\Facades\Gate;

class BookController extends Controller
{

    public function index(FetchBooksService $service)
    {
        // Gate::authorize('viewAny', Book::class);
        return SuccessJsonResponse::make(BookResponse::collection($service->execute()));
    }

    public function store(CreateBookRequest $req, CreateBookService $service)
    {
        Gate::authorize('create', Book::class);
        $saved = $service->execute(BookData::from($req->validated()));
        return SuccessJsonResponse::make((new BookResponse($saved))->build());
    }

    public function show(int $id)
    {
        return SuccessJsonResponse::make((new BookResponse(Book::findOrFail($id)))->build());
    }
    public function update(UpdateBookRequest $req, int $id, UpdateBookService $service)
    {
        $inputs = $req->validated();
        $inputs['book_id']=$id;
        $updated = $service->execute(BookData::from($inputs));
        return SuccessJsonResponse::make((new BookResponse($updated))->build());
    }

    public function destroy(int $id)
    {
        $book = Book::findOrFail($id);
        Gate::authorize('delete', $book);
        return SuccessJsonResponse::make(['success' => $book->delete()]);
    }
}
