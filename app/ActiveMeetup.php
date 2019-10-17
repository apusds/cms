<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActiveMeetup extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "active_meetups";

    /**
     * The primary key associated with the model.
     *
     * @var unsigned integer
     */
    protected  $primaryKey = 'event_id';
    public $incrementing = false;

    public function meetup()
    {
        return $this->belongsTo('App\Meetup', 'event_id', 'id');
    }
}
