<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meetup extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "meetups";

    protected $fillable = [
        'title', 'description', 'event_start', 'event_end', 'location'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

}
