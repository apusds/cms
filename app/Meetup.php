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

    public function attendees() {
        return $this->hasMany('App\Attendee', 'event', 'id');
    }

}
