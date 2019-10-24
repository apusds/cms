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

    protected $fillable = [
        'event', 'file'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function eventData() {
        return Event::all()->find($this->event);
    }

}
