<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('booking_id');
            $table->string('symptoms', 255);
            $table->string('diagnosis', 255);
            $table->string('drugs', 255);
            $table->string('follow_up')->nullable();
            $table->string('image', 50)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data');
    }
}
