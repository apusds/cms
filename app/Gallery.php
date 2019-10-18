<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "galleries";

    public function eventData() {
        return Event::all()->find($this->event);
    }

}
