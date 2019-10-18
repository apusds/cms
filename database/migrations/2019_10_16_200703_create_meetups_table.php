<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetups', function (Blueprint $table) {
            $table->increments('id'); // This is the meetup unique key
            $table->string('title')->unique(); // needed for FK with meetup_attendees
            $table->longText('description')->nullable(); // Not necessary, just "incase"
            $table->timestamp('event_start');
            $table->timestamp('event_end')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('location');
            $table->timestamps(); // created_at, updated_at for tracking
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meetups');
    }
}
