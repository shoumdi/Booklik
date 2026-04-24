<?php

namespace App\Domain\User\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Point extends Model
{
    protected $fillable = ['value'];


    protected static function booted()
    {
        static::creating(function ($point) {
            $point->user_id = Auth::guard()->id();
        });
    }

    public function add(int $val)
    {
        $this->value += $val;
        $this->save();
    }
    public function decrease(int $val)
    {
        $this->value -= $val;
        $this->save();
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function community(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
