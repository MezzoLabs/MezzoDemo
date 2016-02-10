<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductShoppingBasketPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_shopping_basket', function (Blueprint $table) {
            $table->integer('product_id')->unsigned()->index();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->integer('shopping_basket_id')->unsigned()->index();
            $table->foreign('shopping_basket_id')->references('id')->on('shopping_baskets')->onDelete('cascade');
            $table->primary(['product_id', 'shopping_basket_id']);
            $table->integer('amount')->default(1);
            $table->integer('options')->text()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('product_shopping_basket');
    }
}
