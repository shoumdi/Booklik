<?php

namespace App\Service\Communities;

use App\Dto\Communities\CreateCommunityDto;
use App\Http\Responses\Community\CreateCommunityRes;
use App\Models\Community\Community;
use DomainException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateCommunityService
{

    public function execute(CreateCommunityDto $dto)
    {
        $user = Auth::guard()->user();
        $imageUrl = $dto->image->storeAs(
            "users/{$user->id}/communities/images",
            Str::slug(pathinfo($dto->image->getClientOriginalName(), PATHINFO_FILENAME)) . '_' . uniqid() . '.' . $dto->image->extension(),
            'public'
        );
        if($imageUrl === false) throw new DomainException("couldn't upload image");
        $community = DB::transaction(function () use ($dto, $imageUrl,$user) {
            $created = Community::create($dto->inputs());
            $created->images()->create(['url' => $imageUrl]);
            $user->communities()->syncWithoutDetaching([$created->id]);
            return $created;
        });
        return CreateCommunityRes::from($community->load('images'));
    }
}
