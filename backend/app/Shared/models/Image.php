<?php

namespace App\shared\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    protected $fillable = ['url','imageable_id','imageable_type'];

    function imageable():MorphTo{
        return $this->morphTo();
    }
}
