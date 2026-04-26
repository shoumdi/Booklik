<?php

namespace App\Domain\Suggestion\Models;

use App\Domain\Book\Models\Book;
use App\Domain\Community\Models\Community;
use App\Domain\User\Models\User;
use App\Domain\Vote\Models\Vote;
use Core\Trackable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Suggestion extends Model
{
    protected $table = "suggestion" ;
    use Trackable;

    public function community(): BelongsTo
    {
        return $this->belongsTo(Community::class);
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
    public function votes():HasMany{
        return $this->hasMany(Vote::class);
    }
}
