<?php
namespace App\Domain\Genre\Http\Responses;

use Core\Ressource;

class GenreResponse extends Ressource{

protected function toArray(): array
{
    return [
        'id'=>$this->model->id,
        'name'=>$this->model->name,
        'description'=>$this->model->description,
        'books_count'=>$this->model->books()->count(),
        'created_at'=>$this->model->created_at
    ];
}
}