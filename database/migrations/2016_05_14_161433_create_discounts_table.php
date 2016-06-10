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
            $table->smallInteger('type')->comment('type of discount, DC - 0: % ; 1: $, Gift - 2: $');
            $table->smallInteger('status')->comment('status of discount, enable or disable, 1: enable, 0: disable');
            $table->integer('total')->nullable()->comment('total of discount times, can use');
            $table->integer('total_one_user')->nullable()->comment('total of discount times, can use');
            $table->integer('use_count')->default(0)->nullable()->comment('count number of times of user used');
            $table->date('start_time')->comment('apply from date');
            $table->date('end_time')->comment('apply to date');
            $table->integer('condition_orders')->nullable()->comment('condition for discount, number of order user put to system, ex:4 orders');
            $table->string('description',255)->nullable();
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
