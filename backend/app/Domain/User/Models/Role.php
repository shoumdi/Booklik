<?php

namespace App\Domain\User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    protected $fillable = ['name'];
    use HasFactory;

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'user_role');
    }
    //
}
