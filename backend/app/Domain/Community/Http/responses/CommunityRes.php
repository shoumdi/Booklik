<?php

namespace App\domain\community\http\responses;

use Core\CommunityRole;
use Core\Ressource;
use Illuminate\Support\Facades\URL;

class CommunityRes extends Ressource
{
    /**
     * Create a new class instance.
     */

    protected function toArray(): array
    {
        return [
            'id' => $this->model->id,
            'name' => $this->model->name,
            'image_url' => URL::to('/') . $this->model->images[0]->url,
            'role' => ($this->model->created_by === auth()->guard()->id())? CommunityRole::ADMIN->value :CommunityRole::MEMBER->value,
            'members_count' => $this->model->users()->count()
        ];
    }
}
