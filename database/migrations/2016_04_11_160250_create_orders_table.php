<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('shope_id')->nullable();
            $table->string('name');
            $table->text('description');
            $table->integer('number_items');
            $table->integer('number_shippers');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('phone');
            $table->integer('cost');
            $table->float('radius');
            $table->smallInteger('status');
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
        Schema::drop('orders');
    }
}
