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
            $table->integer('status')->default(1)->comment('1:taken, 2: success, 3: payed, 4: cancel');
            $table->dateTime('take_at')->nullable()->comment('when shipper take orders, this field is insert');
            $table->dateTime('finish_at')->nullable()->comment('when shipper ship successfully');
            $table->dateTime('pay_at')->nullable()->comment('in case order type is COD, shipper have to pay for company');
            $table->dateTime('cancel_at')->nullable()->comment('when order is cancelled');
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
