<?php

namespace App\Domain\Book\Http\Controllers;

use App\domain\book\http\requests\CreateBookRequest;
use App\Shared\Http\Controllers\Controller;
use Core\SuccessJsonResponse;

class CreateBookController extends Controller
{
    public function __invoke(CreateBookRequest $req)
    {
        return SuccessJsonResponse::make('true');
    }
}
