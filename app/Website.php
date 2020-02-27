<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{

    protected $fillable = [
        'title', 'keyword', 'philosophy', 'about_us', 'dsc_apu', 'announcement'
    ];

    protected $casts = [
        'created_at' => 'datetime'
    ];

}
