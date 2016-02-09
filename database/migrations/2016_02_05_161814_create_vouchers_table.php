<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('voucher_key')->unique();
            $table->string('type');
            $table->integer('only_for_id')->nullable()->unsigned();
            $table->foreign('only_for_id')->references('id')->on('users');
            $table->boolean('is_global');
            $table->timestamp('active_until')->nullable();
            $table->text('options')->nullable();
            $table->timestamp('redeemed_at')->nullable();
            $table->integer('redeemed_by_id')->nullable()->unsigned();
            $table->foreign('redeemed_by_id')->references('id')->on('users');
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
        Schema::drop('vouchers');
    }
}
