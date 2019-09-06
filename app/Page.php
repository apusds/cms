<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    public function template() { // returns Template data
        return $this->belongsTo('App\Template', 'template', 'id');
    }

    public function user() { // Returns User data
        return $this->belongsTo('App\User', 'created_by', 'id');
    }

}
