<?php

namespace App\Domain\Community\Http\Controllers;

use App\domain\community\http\responses\CommunityDetailsResponse;
use App\Domain\Community\Models\Community;
use App\Shared\Http\Controllers\Controller;
use Core\SuccessJsonResponse;

class CommunityDetailsController extends Controller
{
    public function __invoke(int $id)
    {
        return SuccessJsonResponse::make((new CommunityDetailsResponse(Community::find($id)->load('images')))->build());
    }
}
