<?php

namespace App\Http\Responses\Community;

use App\Models\Community\Community;

class CreateCommunityRes
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        readonly int $id,
        readonly string $name,
        readonly string $imageUrl,
        readonly int $membersCnt
    ) {}

    public static function from(Community $community):self{
        return new self(
            $community->id,
            $community->name,
            $community->images[0]->url,
            $community->users()->count()
        );
    }
}
