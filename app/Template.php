<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    
    public function user() { // Returns the User who created this Template
        return $this->belongsTo('App\User', 'created_by', 'id');
    }

    public function pages() { // returns the amount of Pages using this template (array)
        return $this->hasMany('App\Page', 'template_id', 'id');
    }

}
