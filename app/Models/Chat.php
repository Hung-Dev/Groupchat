<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    //
    protected $fillable = [
        'message',
        'sender',
        'recever',
        'is_seen',
        'is_user_seen',
        'typing',
    ];
}
