<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddedServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('added_services', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('code')->unique()->comment('code of added service, ex: AS123');
            $table->string('name')->comment('name of Added service, ex: Added Service Abc');
            $table->string('vehicle_type_id')->references('id')->on('vehicle_types')->onDelete('cascade');;
            $table->float('freight')->comment('freight of added service, ex: 2.5$');
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
        Schema::drop('added_services');
    }
}
