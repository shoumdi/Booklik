<?php

namespace App\Domain\Book\Models;

use App\Domain\Author\Models\Author;
use App\Domain\Community\Models\CommunityBook;
use App\Domain\Genre\Models\Genre;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    protected $fillable = [
        'title',
        'edition',
        'description',
        'estimated_price'
    ];

    function genres():BelongsToMany{
        return $this->belongsToMany(Genre::class,'book_genre');
    }

    function authors():BelongsToMany{
        return $this->belongsToMany(Author::class,'book_author');
    }
    function suggestions():HasMany{
        return $this->hasMany(Suggestion::class);
    }

    function communityBook():BelongsTo{
        return $this->belongsTo(CommunityBook::class);
    }
}
