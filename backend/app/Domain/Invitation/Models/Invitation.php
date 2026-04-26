<?php

namespace App\Domain\Invitation\Models;

use App\Domain\Community\Models\Community;
use App\Domain\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

class Invitation extends Model
{
    

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }
    public function community():BelongsTo{
        return $this->belongsTo(Community::class);
    }

    public function accept(){
        if($this->status!=='PENDING') return;
        $this->status = 'ACCEPTED';
        $this->save();
    }
    public function refuse(){
        if($this->status!=='PENDING') return;
        $this->status = 'REFUSED';
        $this->save();
    }
}
