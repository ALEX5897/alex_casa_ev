<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightPassengerPivotTable extends Migration
{
    public function up()
    {
        Schema::create('flight_passenger', function (Blueprint $table) {
            $table->unsignedBigInteger('flight_id');
            $table->foreign('flight_id', 'flight_id_fk_9102657')->references('id')->on('flights')->onDelete('cascade');
            $table->unsignedBigInteger('passenger_id');
            $table->foreign('passenger_id', 'passenger_id_fk_9102657')->references('id')->on('passengers')->onDelete('cascade');
        });
    }
}
