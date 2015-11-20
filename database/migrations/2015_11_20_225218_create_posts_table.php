<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');

            $table->text('teaser')->nullable();
            $table->string('slug')->unique();

            $table->string('state');
            $table->date('published_at')->nullable();

            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('content_id')->unsigned()->index();
            $table->foreign('content_id')->references('id')->on('contents');

            $table->integer('main_image_id')->unsigned()->index()->nullable();
            $table->foreign('main_image_id')->references('id')->on('image_files');

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
        Schema::drop('posts');
    }
}
