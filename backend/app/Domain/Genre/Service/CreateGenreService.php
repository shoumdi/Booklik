<?php

namespace App\Domain\Genre\Service;

use App\Domain\Genre\Dto\GenreData;
use App\Domain\Genre\Models\Genre;

class CreateGenreService
{
    public function execute(GenreData $data)
    {
        return Genre::create([
            "name" => $data->name,
            "description" => $data->description,
        ]);
    }
}
