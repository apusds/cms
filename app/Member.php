<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "members";

    protected $fillable = [
        'email', 'name', 'mobile', 'student_id', 'gender', 'intake', 'skills', 'found_us'
    ];

    protected $casts = [
        'created_at' => 'datetime'
    ];

    public function events() {
        return $this->hasMany(MeetupAttendee::class, 'student_id', 'student_id');
    }

}
