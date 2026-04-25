<?php

namespace App\Domain\Community\Http\Responses;

use Core\CommunityRole;
use Core\Ressource;
use Illuminate\Support\Facades\URL;

class CommunityAdminRes extends Ressource
{
    /**
     * Create a new class instance.
     */

    protected function toArray(): array
    {
        $admin = $this->model->admin()->first();
        return [
            'id' => $this->model->id,
            'name' => $this->model->name,
            'image_url' => URL::to('/') . $this->model->images[0]->url,
            'created_by' => $admin->fname . ' ' . $admin->lname,
            'members_count' => $this->model->users()->count(),
            'status'=>$this->model->status
        ];
    }
}
