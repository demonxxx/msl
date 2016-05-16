<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddedServiceOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('added_service_order', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->string('added_service_id')->references('id')->on('added_services')->onDelete('cascade');
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
        Schema::drop('added_service_order');
    }
}
