<?php

namespace App\Domain\Author\Http\Controllers;

use App\Domain\Author\Dto\AuthorData;
use App\Domain\Author\Http\Requests\CreateAuthorRequest;
use App\Domain\Author\Http\Responses\AuthorResponse;
use App\Domain\Author\Models\Author;
use App\Domain\Author\Services\CreateAuthorService;
use App\Shared\Http\Controllers\Controller;
use Core\SuccessJsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CreateAuthorController extends Controller
{
    public function __construct(private CreateAuthorService $service) {}

    public function __invoke(CreateAuthorRequest $req)
    {
        Gate::authorize('create', [Author::class]);
        $created = $this->service->execute(AuthorData::from($req->validated()));
        return SuccessJsonResponse::make((new AuthorResponse($created))->build(), 201);
    }
}
