<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateShippersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('code')->unique()->nullable();
            $table->string('home_number');
            $table->string('home_ward');
            $table->string('home_district');
            $table->string('home_city',255);
            $table->smallInteger('vehicle_type_id')->nullable()->references('id')->on('vehicle_types')->onDelete('cascade');
            $table->string('licence_plate',12);
            $table->string('licence_driver_number',12)->nullable();
            $table->smallInteger('shipper_type_id')->nullable()->references('id')->on('shipper_types')->onDelete('cascade');
            $table->float('average_score')->nullable();
            $table->string('profile_status')->nullable();
            $table->smallInteger('status')->nullable();
            $table->smallInteger('isActive')->default(0)->comment('0: not active, 1: activated');
            
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
        Schema::drop('shippers');
    }
}