<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventAttendees extends Model
{

    protected $table = 'event_attendees';

    protected $fillable = ['student_name', 'student_id', 'email', 'has_checkin'];
    protected $casts = ['created_at', 'updated_at'];

}
