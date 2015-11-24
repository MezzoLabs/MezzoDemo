<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');

            $table->integer('address_id')->unsigned()->index();
            $table->foreign('address_id')->references('id')->on('addresses');

            $table->integer('event_venue_id')->unsigned()->nullable();
            $table->foreign('event_venue_id')->references('id')->on('event_venues');

            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('events');
    }
}
