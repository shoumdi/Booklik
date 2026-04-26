<?php

namespace App\Domain\Community\Models;

use App\Domain\Contribute\Models\Contribution;
use App\Domain\Invitation\Models\Invitation;
use App\Domain\Suggestion\Models\Suggestion;
use App\Domain\User\Models\Point;
use App\Domain\User\Models\User;
use App\Shared\Models\Image;
use Core\Trackable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Laravel\Scout\Searchable;

class Community extends Model
{
    protected $fillable = ['name', 'description'];

    use Trackable;
    use Searchable;

    function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'community_member');
    }
    function admin():BelongsTo{
        return $this->belongsTo(User::class,'created_by');
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

    function invitations():HasMany{
        return $this->hasMany(Invitation::class);
    }
}
