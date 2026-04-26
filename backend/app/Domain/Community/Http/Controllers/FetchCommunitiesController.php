<?php

namespace App\Domain\Community\Http\Controllers;

use App\Domain\Community\Dto\CommunityFilters;
use App\Domain\Community\Http\Responses\CommunityRes;
use App\Domain\Community\Services\FetchCommunitiesService;
use App\Shared\Http\Controllers\Controller;
use Core\SuccessJsonResponse;
use Symfony\Component\Console\Input\Input;

class FetchCommunitiesController extends Controller
{
    public function __construct(
        private FetchCommunitiesService $service
    ) {}
    public function __invoke()
    {
        $inputs = request()->query();
        return SuccessJsonResponse::make(CommunityRes::collection($this->service->execute(CommunityFilters::from($inputs))));
    }
}
