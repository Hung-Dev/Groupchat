<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Typing extends Model
{
    //
    protected $fillable = [
        'sender',
        'recever',
        'check_status',
    ];
}
