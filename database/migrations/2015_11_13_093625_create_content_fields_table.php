<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContentFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('field_key');
            $table->string('value_type');
            $table->text('value');
            $table->timestamps();

            $table->integer('content_block_id')->unsigned()->index();
            $table->foreign('content_block_id')->references('id')->on('content_blocks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('content_fields');
    }
}
