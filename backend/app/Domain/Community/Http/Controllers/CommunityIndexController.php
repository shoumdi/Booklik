<?php

namespace App\Domain\Community\Http\Controllers;

use App\domain\community\services\FetchCommunitiesService;
use App\Shared\Http\Controllers\Controller;
use Core\SuccessJsonResponse;

class CommunityIndexController extends Controller
{
    public function __construct(
        private FetchCommunitiesService $service
    ) {}
    public function __invoke()
    {
        return SuccessJsonResponse::make($this->service->execute());
    }
}
