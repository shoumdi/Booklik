<?php

namespace App\Domain\Genre\Http\Controllers;

use App\Domain\Genre\Dto\GenreData;
use App\Domain\Genre\Http\Requests\CreateGenreRequest;
use App\Domain\Genre\Http\Responses\GenreResponse;
use App\Domain\Genre\Models\Genre;
use App\Domain\Genre\Service\CreateGenreService;
use App\Shared\Http\Controllers\Controller;
use Core\SuccessJsonResponse;
use Illuminate\Support\Facades\Gate;

class CreateGenreController extends Controller
{
    public function __construct(
        private CreateGenreService $service
    ) {}
    public function __invoke(
        CreateGenreRequest $req
    ) {
        Gate::authorize('create',[Genre::class]);
        $saved = $this->service->execute(GenreData::form($req->validated()));
        return SuccessJsonResponse::make((new GenreResponse($saved))->build(), 201);
    }
}
