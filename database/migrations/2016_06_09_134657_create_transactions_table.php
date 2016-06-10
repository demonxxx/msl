<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string("code");
            $table->integer('creator_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer("amount");
            $table->smallInteger("transaction_type");
            $table->smallInteger("account_type");
            $table->text("note");
            $table->dateTime("transaction_date");
            $table->integer("total_user");
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
        Schema::drop('transactions');
    }
}
