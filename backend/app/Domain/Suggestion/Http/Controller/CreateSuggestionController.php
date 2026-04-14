<?php

namespace App\Domain\Suggestion\Http\Controllers;

use App\Domain\Suggestion\Dto\SuggestionData;
use App\Domain\Suggestion\Http\Requests\CreateSuggestionRequest;
use App\Domain\Suggestion\Http\Responses\SuggestionResponse;
use App\Domain\Suggestion\Services\CreateSuggestionService;
use App\Shared\Http\Controllers\Controller;
use Core\SuccessJsonResponse;

class CreateSuggestionController extends Controller
{
    public function __construct(
        private CreateSuggestionService $service
    ) {}
    public function __invoke(CreateSuggestionRequest $req)
    {
        $created = $this->service->execute(SuggestionData::from($req->validated()));
        return SuccessJsonResponse::make(
            data: (new SuggestionResponse($created)->build()),
            status: 201,
            message: 'suggestion created successfully'
        );
    }
}
