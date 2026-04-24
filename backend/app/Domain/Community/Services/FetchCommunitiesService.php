<?php 
namespace App\Domain\Community\Services;


class FetchCommunitiesService {
    public function execute(){
        return auth()->guard()->user()->communities()->get();
    }
}