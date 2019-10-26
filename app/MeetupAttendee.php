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

    const UPDATED_AT = null;
    const CREATED_AT = 'joined_at';

    public function member()
    {
        return $this->belongsTo('App\Member', 'student_id', 'student_id');
    }

}
