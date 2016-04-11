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
            $table->integer('order_id');
            $table->integer('shipper_id');
            $table->integer('status');
            $table->integer('ship_status');
            $table->float('score');
            $table->smallInteger('satisfy_level');
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
        Schema::drop('order_shipper');
    }
}
