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
            $table->integer('shop_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('shipper_id')->references('id')->on('users')->onDelete('cascade');
            $table->smallInteger('type')->default(1)->comment('1:like, 2:block');
            $table->text('description')->nullable();
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
        Schema::drop('shop_shipper');
    }
}
