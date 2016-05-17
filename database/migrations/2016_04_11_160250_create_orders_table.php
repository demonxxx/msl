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
            $table->string('name')->nullable()->comment('name of order');
            $table->text('description')->nullable();
            $table->string('full_address_from')->nullable();
            $table->string('address_from')->nullable();
            $table->string('ward_from')->nullable();
            $table->string('district_from')->nullable();
            $table->string('full_address_to')->nullable();
            $table->string('address_to')->nullable();
            $table->string('ward_to')->nullable();
            $table->string('district_to')->nullable();
            $table->decimal('longitude')->nullable();
            $table->decimal('latitude')->nullable();
            $table->float('distance')->nullable();
            $table->float('base_freight')->nullable()->comment('base freight of order');
            $table->float('vas_freight')->nullable()->comment('added service freight');
            $table->float('discount_freight')->nullable()->comment('discount freight');
            $table->float('weight')->nullable();
            $table->float('order_values')->nullable();
            $table->float('main_freight')->nullable();
            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->smallInteger('status')->default(1)->comment('1: putted, 2: taken, 3: completed');
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
