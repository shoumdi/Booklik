<?php

namespace App\Domain\Community\Models;

use App\Domain\Book\Models\Book;
use App\Domain\Booking\Models\Booking;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CommunityBook extends Model
{

    public function community(): BelongsTo
    {
        return $this->belongsTo(Community::class);
    }
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
