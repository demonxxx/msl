<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('code')->unique()->comment('code of discount program, ex: DC123');
            $table->string('name')->comment('name of discount program, ex: Discount abc');
            $table->string('code_number', 6)->comment('contain a string have 6 digit, user type at put orders to discount orders, ex: ABC123');
            $table->float('amount')->comment('Amount of discount code, ex: 2$');
            $table->smallInteger('type')->comment('type of discount, it can follow % of order cost or cash');
            $table->smallInteger('status')->comment('status of discount, enable or disable');
            $table->integer('total')->nullable()->comment('total of discount times, can use');
            $table->integer('total_one_user')->nullable()->comment('total of discount times, can use');
            $table->integer('use_count')->nullable()->comment('count number of times of user can use');
            $table->dateTime('start_time')->comment('apply from date');
            $table->dateTime('end_time')->comment('apply to date');
            $table->integer('condition_orders')->nullable()->comment('condition for discount, number of order user put to system, ex:4 orders');
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
        Schema::drop('discounts');
    }
}
