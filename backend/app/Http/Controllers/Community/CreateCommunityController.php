<?php

namespace App\Http\Controllers\Community;

use App\Dto\Communities\CreateCommunityDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Communities\CreateCommunityRequest;
use App\Service\Communities\CreateCommunityService;
use Core\SuccessJsonResponse;
use Illuminate\Http\Request;

class CreateCommunityController extends Controller
{
    public function __construct(private CreateCommunityService $community)
    {
    }
    public function __invoke(CreateCommunityRequest $req)
    {
      $saved = $this->community->execute(CreateCommunityDto::from($req->validated()));
      return SuccessJsonResponse::make($saved,201,'succesfully');
    }
}
