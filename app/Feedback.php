<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $fillable = ['email'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

}
