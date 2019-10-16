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
            $table->string('title');
            $table->longText('description')->nullable(); // Not necessary, just "incase"
            $table->timestamp('held_on'); // So Carbon() can kick in
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
