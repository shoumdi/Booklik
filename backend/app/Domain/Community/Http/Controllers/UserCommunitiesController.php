<?php

namespace App\Domain\Community\Http\Controllers;

use App\Domain\Community\Dto\CommunityFilters;
use App\Domain\Community\Http\Responses\CommunityDetailsResponse;
use App\Domain\Community\Http\Responses\CommunityRes;
use App\Domain\Community\Models\Community;
use App\Domain\Community\Services\FetchCommunitiesService;
use App\Shared\Http\Controllers\Controller;
use Core\SuccessJsonResponse;
use Symfony\Component\Console\Input\Input;

class UserCommunitiesController extends Controller
{
    public function __construct(
    ) {}
    public function index()
    {
        $communities = auth()->user()->communities()->get();
        return SuccessJsonResponse::make(CommunityRes::collection($communities));
    }

    public function show(int $id)
    {
        $community = Community::find($id);
        return SuccessJsonResponse::make((new CommunityDetailsResponse($community))->build());
    }
}
