<?php

namespace App\Domain\Vote\Models;

use App\Domain\Suggestion\Models\Suggestion;
use Core\Trackable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vote extends Model
{
    use Trackable;
    public function suggestion(): BelongsTo
    {
        return $this->belongsTo(Suggestion::class);
    }

    public function toggleVote()
    {
        $this->voted = !$this->voted;
        $this->save();
    }
}
