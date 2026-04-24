<?php

namespace App\Domain\Booking\Models;

use App\Domain\Community\Models\CommunityBook;
use Core\Trackable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use Trackable;
    protected $fillable = ['days_number'];
    public function book(): BelongsTo
    {
        return $this->belongsTo(CommunityBook::class);
    }
}
