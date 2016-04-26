<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopShippersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_shippers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('shipper_id')->references('id')->on('users')->onDelete('cascade');
            $table->smallInteger('status')->nullable();
            $table->text('description')->nullable();
            $table->float('score')->nullable();
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
