<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddTrackingCodeAndNoteToOrdersAndBaskets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shopping_baskets', function (Blueprint $table) {
            $table->text('note')->default('');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->text('note')->default('');
            $table->string('tracking_code')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shopping_baskets', function (Blueprint $table) {
            $table->dropColumn('note');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('note');
            $table->dropColumn('tracking_code');
        });
    }
}
