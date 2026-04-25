<?php

namespace App\Domain\User\Http\Responses;

use Core\Ressource;

class AdminUsersList extends Ressource
{

    protected function toArray(): array
    {
        return [
            'id'=>$this->model->id,
            'fullname'=>$this->model->fname . ' ' . $this->model->lname,
            'profile_picture'=>$this->model->profilePicture()->first()->get ?? '',
            'communities_count'=>$this->model->communities()->count(),
            'contributions'=>$this->model->contributions()->sum('amount')
        ];
    }
}
