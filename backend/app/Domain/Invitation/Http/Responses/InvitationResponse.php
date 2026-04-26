<?php
namespace App\Domain\Invitation\Http\Responses;

use Core\Ressource;

class InvitationResponse extends Ressource{
    protected function toArray(): array
    {
        return [
            'community_id'=>$this->model->community()->first()->id,
            'status'=>$this->model->status
            ];
    }
}