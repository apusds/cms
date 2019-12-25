<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserStorage extends Model
{

    protected $fillable = ['email', 'casST'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

}
