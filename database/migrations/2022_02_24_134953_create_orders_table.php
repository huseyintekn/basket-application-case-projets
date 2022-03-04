<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('order_id')->unsigned()->unique();
            $table->unsignedBigInteger('customerId');
            $table->decimal('total',15, 4);
            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->bigIncrements('order_item_id')->unsigned()->unique();
            $table->unsignedBigInteger('order_id');
            $table->integer('productId');
            $table->integer('quantity');
            $table->decimal('unitPrice',15,4);
            $table->decimal('total',15, 4);
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
        Schema::dropIfExists('orders');
    }
}
