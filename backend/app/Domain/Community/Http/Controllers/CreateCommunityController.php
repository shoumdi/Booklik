<?php

namespace App\Domain\Community\Http\Controllers;

use App\domain\community\dto\CreateCommunityData;
use App\domain\community\http\requests\CreateCommunityRequest;
use App\domain\community\services\CreateCommunityService;
use App\Shared\Http\Controllers\Controller;
use Core\SuccessJsonResponse;
use Illuminate\Http\Request;

class CreateCommunityController extends Controller
{
    public function __construct(private CreateCommunityService $community)
    {
    }
    public function __invoke(CreateCommunityRequest $req)
    {
      $saved = $this->community->execute(CreateCommunityData::from($req->validated()));
      return SuccessJsonResponse::make($saved->build(),201,'succesfully');
    }
}
