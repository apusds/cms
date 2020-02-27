<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $fillable = [
        'name'
    ];

    protected $casts = [
        'created_at' => 'datetime'
    ];

}
