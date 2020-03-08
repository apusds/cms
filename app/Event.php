<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    protected $primaryKey = 'id';

    protected $fillable = [
        'created_by', 'organisation', 'title', 'identifier', 'file', 'description', 'attendance', 'expiry', 'registration'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

}
