<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "members";

    protected $fillable = [
        'email', 'name', 'mobile', 'student_id', 'gender', 'intake', 'skills', 'found_us', 'password'
    ];

    protected $casts = [
        'created_at' => 'datetime'
    ];

    protected $hidden = ['password'];

    public function events() {
        return $this->hasMany(MeetupAttendee::class, 'student_id', 'student_id');
    }

    public function scopeSearch($query, $q) {
        if ($q == null) return $query;
        return $query
            ->where('email', 'LIKE', "%{$q}%")
            ->orWhere('name', 'LIKE', "%{$q}%")
            ->orWhere('student_id', 'LIKE', "%{$q}%")
            ->orWhere('intake', 'LIKE', "%{$q}%")
            ->orWhere('skills', 'LIKE', "%{$q}%")
            ->orWhere('found_us', 'LIKE', "%{$q}%");
    }
}
