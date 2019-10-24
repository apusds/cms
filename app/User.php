<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'role_id'
    ];

    protected $casts = ['created_at' => 'datetime'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password'];

    public function role() {
        return $this->belongsTo('App\Role');
    }

    public function events() {
        return $this->hasMany('App\Event', 'created_by', 'id');
    }

    public function hasAllowedRole(): bool {
        return $this->role->id > 0 ? true : false;
    }

    public function isSuperAdmin(): bool {
        return $this->role->id === 1 ? true : false;
    }

    public function isAdmin(): bool {
        return $this->role->id === 2 ? true : false;
    }
}
