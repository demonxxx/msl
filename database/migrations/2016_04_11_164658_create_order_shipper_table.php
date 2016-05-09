<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderShipperTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_shipper', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->integer('shipper_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('status')->nullable();
            $table->integer('ship_status')->nullable();
            $table->float('score')->nullable();
            $table->smallInteger('satisfy_level')->nullable();
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
        Schema::drop('order_shipper');
    }
}
