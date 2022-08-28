<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->dateTime("date_from");
            $table->dateTime("date_to");
            $table->dateTime("boarding_time");
            $table->dateTime("check_in_time");
            $table->double('price', 8, 2);
            $table->foreignId('department_airport')->constrained('airports');
            $table->foreignId('arrival_airport')->constrained('airports');
            $table->foreignId('airplane_id')->constrained('airplanes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flights');
    }
};
