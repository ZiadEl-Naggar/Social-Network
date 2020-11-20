<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use HasFactory;

    public function person(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function requestedfriend(){
        return $this->belongsTo(User::class, 'friend_id');
    }
}
