<?php

namespace App\Domain\Book\Models;

use App\Domain\Author\Models\Author;
use App\Domain\Genre\Models\Genre;
use App\Domain\Suggestion\Models\Suggestion;
use App\Shared\Models\Image;
use Core\Trackable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Book extends Model
{
    use Trackable;
    protected $fillable = [
        'title',
        'edition',
        'description',
        'estimated_price'
    ];

    function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'book_genre')->withTimestamps();
    }

    function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'book_author')->withTimestamps();
    }
    function suggestions(): HasMany
    {
        return $this->hasMany(Suggestion::class);
    }
    function cover(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
