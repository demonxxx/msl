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
            $table->integer('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('code')->comment('code of order');
            $table->integer('order_type_id')->references('id')->on('order_types')->onDelete('cascade');
            $table->string('name')->comment('name of order');
            $table->text('description');
            $table->string('address_from');
            $table->string('ward_from');
            $table->string('district_from');
            $table->string('address_to');
            $table->string('ward_to');
            $table->string('district_to');
            $table->float('distance')->nullable();
            $table->float('base_freight')->nullable()->comment('base freight of order');
            $table->float('vas_freight')->nullable()->commnet('added service freight');
            $table->float('discount_freight')->nullable()->commnet('discount freight');
            $table->float('weight')->nullable();
            $table->float('order_values')->nullable();
            $table->float('main_freight')->nullable();
            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->smallInteger('status')->nullable();
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
        Schema::drop('orders');
    }
}
