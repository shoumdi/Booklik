<?php

namespace App\Domain\Suggestion\Models;

use App\Domain\Book\Models\Book;
use App\Domain\Community\Models\Community;
use App\Domain\User\Models\User;
use Core\Trackable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Suggestion extends Model
{

    use Trackable;

    public function community(): BelongsTo
    {
        return $this->belongsTo(Community::class);
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
