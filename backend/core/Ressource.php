<?php

namespace Core;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class Ressource
{
    public function __construct(
        protected Model $model
    ) {}

    protected abstract function toArray():array;


    public static function collection(Collection $collection) {
        return $collection->map(fn($m)=>(new (static::class)($m))->toArray());
    }


    public function build() {
        return $this->toArray();
    }
}
