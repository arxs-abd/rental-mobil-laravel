<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_rent_id');
            $table->unsignedBigInteger('car_id');
            $table->string('start_time');
            $table->string('end_time');
            $table->integer('total_price');
            $table->string('status');
            $table->timestamps();

            $table->foreign('user_rent_id')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('car_id')->references('id')->on('car')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
