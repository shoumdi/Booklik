<?php

namespace App\Domain\Community\Http\Responses;

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
            'description' => $this->model->description,
            'image_url' => $this->model->images[0]->url,
            'role' => ($this->model->created_by === auth()->guard()->id())? CommunityRole::ADMIN->value :CommunityRole::MEMBER->value,
            'members_count' => $this->model->users()->count(),
            'invitation_status'=>$this->model->invitations()->where('user_id',auth()->id())->first()->status ?? null
        ];
    }
}
