<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeetupAttendee extends Model
{

    protected $table = "meetup_attendees";

    protected $fillable = [
        'student_id', 'meetup_title'
    ];

    protected $casts = [
        'joined_at' => 'datetime'
    ];

    public function member()
    {
        return $this->belongsTo('App\Member', 'student_id', 'student_id');
    }

}
