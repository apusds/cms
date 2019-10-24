<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = "id";

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'events';

    protected $fillable = [
        'created_by', 'organisation', 'title', 'identifier', 'file', 'description', 'form', 'expiry'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

}
