<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopShipperTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_shipper', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop_id');
            $table->integer('shipper_id');
            $table->smallInteger('status');
            $table->text('description');
            $table->float('score');
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
        Schema::drop('shop_shipper');
    }
}
