<?php

namespace App\Domain\Community\Services;

use App\Domain\Community\dto\CreateCommunityData;
use App\Domain\Community\Http\Responses\CommunityRes;
use App\Domain\Community\Models\Community;
use App\Domain\User\Services\CalculatePoints;
use DomainException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CreateCommunityService
{

    public function execute(CreateCommunityData $dto)
    {
        $user = Auth::guard()->user();
        $imageUrl = $dto->image->storeAs(
            "users/{$user->id}/communities/images",
            Str::slug(pathinfo($dto->image->getClientOriginalName(), PATHINFO_FILENAME)) . '_' . uniqid() . '.' . $dto->image->extension(),
            'public'
        );
        if ($imageUrl === false) throw new DomainException("couldn't upload image");
        $community = DB::transaction(function () use ($dto, $imageUrl, $user) {
            $created = Community::create($dto->inputs());
            $created->images()->create(['url' => Storage::url($imageUrl)]);
            $user->communities()->syncWithoutDetaching([$created->id]);
            $created->points()->create([
                'value' => CalculatePoints::joinPoints($created)
            ]);
            return $created;
        });
        return new CommunityRes($community->load('images'));
    }
}
