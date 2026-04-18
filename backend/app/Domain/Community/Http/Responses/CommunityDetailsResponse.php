<?php
namespace App\Domain\Community\Http\Responses;

use Core\Ressource;
use Illuminate\Support\Facades\URL;

class CommunityDetailsResponse extends Ressource
{
    protected function toArray(): array
    {
        return [
            'name' => $this->model->name,
            'details' => $this->model->details,
            'image_url' => URL::to('/') . $this->model->images[0]->url,
            'stats' => [
                'members_count' => $this->model->users()->count()
            ]
        ];
    }
}
