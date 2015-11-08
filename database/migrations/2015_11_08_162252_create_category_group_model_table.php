<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoryGroupModel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_group_model', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_group_id')->unsigned()->index();
            $table->foreign('category_group_id')->references('id')->on('category_groups')->onDelete('cascade');
            $table->string('model');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('category_group_model');
    }
}
