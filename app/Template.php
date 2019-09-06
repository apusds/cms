<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{

    public function user() { // Returns the User who created this Template
        return $this->belongsTo('App\User', 'created_by', 'id');
    }

}
