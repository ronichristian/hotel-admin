<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfirmedBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('confirmed_bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('booking_id');
            $table->integer('room_cat_id');
            $table->integer('room_no');
            $table->double('room_rate');
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('nights');
            $table->string('status');
            $table->double('total');
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
        Schema::dropIfExists('confirmed_bookings');
    }
}
