<?php

namespace App\Domain\Community\Models;

use App\Domain\Contribute\Models\Contribution;
use App\Domain\Suggestion\Models\Suggestion;
use App\Domain\User\Models\Point;
use App\Domain\User\Models\User;
use App\Shared\Models\Image;
use Core\Trackable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Community extends Model
{
    protected $fillable = ['name', 'description'];

    use Trackable;

    function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'community_member');
    }

    function suggestions(): HasMany
    {
        return $this->hasMany(Suggestion::class);
    }
    function contributions(): HasMany
    {
        return $this->hasMany(Contribution::class);
    }

    function points(): HasMany
    {
        return $this->hasMany(Point::class);
    }
}
