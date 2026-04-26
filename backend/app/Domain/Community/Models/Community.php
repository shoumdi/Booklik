<?php

namespace App\Domain\Community\Models;

use App\Domain\User\Models\User;
use App\Shared\Models\Image;
use Core\Trackable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Laravel\Scout\Searchable;

class Community extends Model
{
    protected $fillable = ['name','description'];

    use Trackable;
<<<<<<< Updated upstream
    
=======
    use Searchable;

>>>>>>> Stashed changes
    function images(): MorphMany
    {
        return $this->morphMany(Image::class,'imageable');
    }
    function users():BelongsToMany{
        return $this->belongsToMany(User::class,'community_member');
    }
}
