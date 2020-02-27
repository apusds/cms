<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Committee extends Model
{

    protected $fillable = [
        'name', 'email', 'role', 'facebook', 'twitter', 'linkedln', 'instagram', 'file'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

}
