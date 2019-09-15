<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{

    protected $table = "galleries";

    public function eventData() {
        return Event::all()->find($this->event);
    }

}
