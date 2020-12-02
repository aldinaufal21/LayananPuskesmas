<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntrianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antrian', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->integer('antrian');
            $table->unsignedBigInteger('id_pemeriksaan');
            $table->unsignedBigInteger('id_poli');
            $table->timestamps();

            $table->foreign('id_pemeriksaan')->references('id')->on('pemeriksaan');
            $table->foreign('id_poli')->references('id')->on('poli');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('antrian');
    }
}
