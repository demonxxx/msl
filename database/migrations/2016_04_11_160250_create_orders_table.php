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
            $table->integer('order_type_id')->references('id')->on('order_types')   ->onDelete('cascade');
            $table->integer('vehicle_type_id')->references('id')->on('vehicle_types')->onDelete('cascade');
            $table->string('name')->nullable()->comment('name of order');
            $table->text('description')->nullable();
            $table->string('full_address_from')->nullable();
            $table->string('street_from')->nullable();
            $table->string('street_to')->nullable();
            $table->string('address_from')->nullable();
            $table->string('ward_from')->nullable();
            $table->string('district_from')->nullable();
            $table->string('recipient_name')->nullable();
            $table->string('recipient_phone')->nullable();
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
            $table->float('rate_score')->nullable();
            $table->integer('shipper_id')->references('id')->on('users')->onDelete('cascade');
            $table->dateTime('taken_order_at')->nullable()->comment('when shipper take orders, this field is insert');
            $table->dateTime('taken_items_at')->nullable()->comment('when shipper take orders, this field is insert');
            $table->dateTime('ship_success_at')->nullable()->comment('when shipper ship successfully');
            $table->dateTime('payed_at')->nullable()->comment('in case order type is COD, shipper have to pay for company');
            $table->dateTime('shop_cancel_at')->nullable()->comment('when order is cancelled');
            $table->dateTime('return_items_at')->nullable()->comment('when order is cancelled');
            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->longText('ship_path')->nullable();
            $table->smallInteger('status')->default(1)->comment('1: pending, 2: taken order, 3: taken items, 4, shipping, 5 ship success,
            6: payed (COD order),7. cancel order (SHOP), 8 Return items. 9, Returning items.');
            $table->string('image_url')->nullable();
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
