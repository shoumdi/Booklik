<?php

namespace App\Domain\Vote\Http\Responses;

use Core\Ressource;

class VoteResponse extends Ressource
{
    protected function toArray(): array
    {
        return [
            'suggestion_id' => $this->model->suggestion->id,
            'count' => $this->model->suggestion->whereHas('votes', fn($q) => $q->where('voted', 'true'))->count()
        ];
    }
}
