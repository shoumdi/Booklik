<?php

namespace App\Domain\Community\Http\Controllers\Admin;

use App\Domain\Community\Http\Responses\CommunityAdminRes;
use App\Domain\Community\Models\Community;
use App\Shared\Http\Controllers\Controller;
use Core\SuccessJsonResponse;

class CommunityController extends Controller
{
    public function __construct() {}
    public function index()
    {
        return SuccessJsonResponse::make(CommunityAdminRes::collection(Community::orderBy('created_at','desc')->get()));
    }

    public function update(int $id)
    {
        $inputs = request()->validate(['status' => ['string', 'required']]);
        $community = Community::findOrFail($id);
        $community->status = $inputs['status'];
        $community->save();
        return SuccessJsonResponse::make((new CommunityAdminRes($community))->build());
    }
}
