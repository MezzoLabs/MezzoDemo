<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddClicksFieldToPostsAndEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->integer('clicks')->unsigned()->default(0);
        });

        Schema::table('events', function (Blueprint $table) {
            $table->integer('clicks')->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('clicks');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('clicks');
        });
    }
}
