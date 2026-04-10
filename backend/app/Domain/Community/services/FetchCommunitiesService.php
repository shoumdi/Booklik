<?php 
namespace App\domain\community\services;

use App\domain\community\http\responses\CommunityRes;

class FetchCommunitiesService {
    public function execute(){
        return CommunityRes::collection(auth()->guard()->user()->communities()->get());
    }
}