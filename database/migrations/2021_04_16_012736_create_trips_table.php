<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('route_id');
            $table->date('date');
            $table->integer('number');
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->unsignedBigInteger('bus_id');
            $table->unsignedBigInteger('driver_id');
            $table->unsignedBigInteger('ticket_collector_id');
            $table->unsignedBigInteger('operator_id');
            $table->unsignedBigInteger('next_station_id');
            $table->integer('status');
            $table->timestamp('arrive_at');
            $table->integer('passenger');
            $table->timestamps();
            $table->foreign('route_id')->references('id')->on('routes');
            $table->foreign('bus_id')->references('id')->on('buses');
            $table->foreign('driver_id')->references('id')->on('staffs');
            $table->foreign('ticket_collector_id')->references('id')->on('staffs');
            $table->foreign('operator_id')->references('id')->on('staffs');
            $table->foreign('next_station_id')->references('id')->on('stations');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trips');
    }
}
