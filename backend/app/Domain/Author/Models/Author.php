<?php

namespace App\Domain\Author\Models;

use App\Domain\Book\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Author extends Model
{
    protected $fillable = ['fname','lname'];
    function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'book_author');
    }
}
