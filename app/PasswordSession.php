<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordSession extends Model
{

    protected $fillable = ['email', 'token'];
    protected $casts = ['created_at', 'updated_at'];

}
