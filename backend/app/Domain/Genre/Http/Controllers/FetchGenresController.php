<?php

namespace App\Domain\Genre\Http\Controllers;

use App\Domain\Genre\Http\Responses\GenreResponse;
use App\Domain\Genre\Models\Genre;
use Core\SuccessJsonResponse;
use Illuminate\Support\Facades\Gate;

class FetchGenresController
{
    public function __invoke(

    )
    {
        Gate::authorize('viewAny',Genre::class);
        return SuccessJsonResponse::make(GenreResponse::collection(Genre::all()),200);
    }
}
