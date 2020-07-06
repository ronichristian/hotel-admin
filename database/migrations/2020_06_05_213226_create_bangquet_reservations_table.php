<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBangquetReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bangquet_reservations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('event_name');
            $table->string('engager_name');
            $table->string('address');
            $table->string('company')->nullable();
            $table->string('company_address')->nullable();
            
            $table->integer('venue');
            $table->string('status');
            $table->bigInteger('phone_number');
            $table->string('email_address');
            $table->date('date_of_event');
            $table->date('time_of_event');
            $table->integer('no_of_pax')->nullable();
            $table->string('motif')->nullable();
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
        Schema::dropIfExists('bangquet_reservations');
    }
}
