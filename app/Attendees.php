<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendees extends Model
{

    protected $fillable = [
        'student_id', 'event_title'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

}
