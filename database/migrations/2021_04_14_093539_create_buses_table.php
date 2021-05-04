<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->integer('seat');
            $table->integer('capacity');
            $table->unsignedBigInteger('route_id1');
            $table->unsignedBigInteger('route_id2');
            $table->date('last_workday');
            $table->unsignedBigInteger('last_worktime');
            $table->unsignedBigInteger('last_station_id');
            $table->timestamps();
            $table->foreign('route_id1')->references('id')->on('routes');
            $table->foreign('route_id2')->references('id')->on('routes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buses');
    }
}
