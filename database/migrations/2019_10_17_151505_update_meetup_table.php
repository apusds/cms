<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMeetupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Drop held on column
        Schema::table('meetups', function (Blueprint $table) {
            $table->dropColumn('held_on');
        });

        Schema::table('meetups', function (Blueprint $table) {
            $table->timestamp('event_start');
            $table->timestamp('event_end');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
