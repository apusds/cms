<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Committee extends Model
{

    protected $fillable = [
        'name', 'email', 'role', 'facebook', 'twitter', 'linkedln', 'instagram', 'file', 'isActive', 'summary'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

}
