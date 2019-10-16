<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meetups extends Model
{
    /**
     * primaryKey
     *
     * @var integer
     * @access protected
     */
    protected $primaryKey = null;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    // One to One with Events table


    // One to Many with Members table

}
