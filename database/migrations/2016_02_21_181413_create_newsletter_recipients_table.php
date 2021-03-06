<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNewsletterRecipientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newsletter_recipients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('state');
            $table->string('ip_address');
            $table->string('confirmation_code');
            $table->text('confirmation_text');
            $table->timestamp('confirmed_at')->nullable();
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
        Schema::drop('newsletter_recipients');
    }
}
