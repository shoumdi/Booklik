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

class GenresController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', Genre::class);
        return SuccessJsonResponse::make(GenreResponse::collection(Genre::all()), 200);
    }
    public function store(CreateGenreRequest $req, CreateGenreService $service)
    {
        Gate::authorize('create', [Genre::class]);
        $saved = $service->execute(GenreData::form($req->validated()));
        return SuccessJsonResponse::make((new GenreResponse($saved))->build(), 201);
    }

    public function destroy()
    {
        $name = request()->validate(['name' => 'required', 'string']);
        Gate::authorize('destroy', [Genre::class]);
        return SuccessJsonResponse::make(['success' => Genre::where('name',$name)->delete()]);
    }
}
