<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddLockedFieldsToEventsAndPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->integer('locked_by_id')->unsigned()->nullable();
            $table->foreign('locked_by_id')->references('id')->on('users')->onDelete('restrict');

            $table->timestamp('locked_until')->nullable();
        });

        Schema::table('events', function (Blueprint $table) {
            $table->integer('locked_by_id')->unsigned()->nullable();
            $table->foreign('locked_by_id')->references('id')->on('users')->onDelete('restrict');

            $table->timestamp('locked_until')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign('posts_locked_by_id_foreign');
            $table->dropColumn('locked_by_id');
            $table->dropColumn('locked_until');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign('events_locked_by_id_foreign');
            $table->dropColumn('locked_by_id');
            $table->dropColumn('locked_until');
        });
    }
}
