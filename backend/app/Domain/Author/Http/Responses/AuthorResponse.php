<?php

namespace App\Domain\Author\Http\Responses;

use Core\Ressource;

class AuthorResponse extends Ressource {

protected function toArray(): array
{
    return [
        'first_name'=>$this->model->fname,
        'last_name'=>$this->model->lname,
    ];
}
}
