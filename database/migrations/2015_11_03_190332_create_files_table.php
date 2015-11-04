<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('folder');
            $table->string('filename');
            $table->string('extension');
            $table->text('info')->nullable();
            $table->timestamps();

            $table->unique(array('folder', 'filename', 'extension'));
            $table->unique(array('folder', 'title'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('files');
    }
}
