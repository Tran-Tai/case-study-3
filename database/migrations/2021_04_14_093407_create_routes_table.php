<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reverse_route_id');
            $table->integer('number');
            $table->string('name');
            $table->integer('direction');
            $table->integer('total_station');
            $table->unsignedBigInteger('first_station_id');
            $table->unsignedBigInteger('last_station_id');
            $table->bigInteger('total_time');
            $table->bigInteger('time_interval');
            $table->timestamps();
            $table->foreign('first_station_id')->references('id')->on('stations');
            $table->foreign('last_station_id')->references('id')->on('stations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('routes');
    }
}
