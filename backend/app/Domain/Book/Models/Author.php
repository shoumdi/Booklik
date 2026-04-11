<?php

namespace App\Domain\Book\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Author extends Model
{


    function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'book_author');
    }
}
