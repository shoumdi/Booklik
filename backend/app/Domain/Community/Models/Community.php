<?php

namespace App\Domain\Community\Models;

use App\Models\Image;
use App\Models\User;
use Core\Trackable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Community extends Model
{
    protected $fillable = ['name','description'];

    use Trackable;
    
    function images(): MorphMany
    {
        return $this->morphMany(Image::class,'imageable');
    }
    function users():BelongsToMany{
        return $this->belongsToMany(User::class,'community_member');
    }
}
