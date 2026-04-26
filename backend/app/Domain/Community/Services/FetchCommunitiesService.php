<?php 
namespace App\Domain\Community\Services;

use App\Domain\Community\Dto\CommunityFilters;
use App\Domain\Community\Models\Community;

class FetchCommunitiesService {
    public function execute(CommunityFilters $filters){
        return Community::search($filters->search)->get();
    }
}