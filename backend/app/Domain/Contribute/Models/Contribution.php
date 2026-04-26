<?php

namespace App\Domain\Contribute\Models;

use App\Domain\Community\Models\Community;
use App\Domain\User\Models\User;
use Core\Trackable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Contribution extends Model
{
    protected $fillable = ['amount','made_by'];


    public function community(): BelongsTo
    {
        return $this->belongsTo(Community::class);
    }
    public function contributer(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
