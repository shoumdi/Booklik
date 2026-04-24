<?php
namespace App\Domain\User\Http\Responses;

use Core\Ressource;

class AuthenticatedResponse extends Ressource{

protected function toArray(): array
{
    return [
        'id'=>$this->model->id,
        'fullname'=>$this->model->fname . ' ' . $this->model->lname,
        'email'=>$this->model->email,
        'roles'=>$this->model->roles->map(fn($r) => $r->name),
    ];
}
}