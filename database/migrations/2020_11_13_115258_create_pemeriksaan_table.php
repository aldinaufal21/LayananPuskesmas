<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemeriksaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemeriksaan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_poli');
            $table->string('keluhan');
            $table->unsignedBigInteger('id_pasien');
            $table->integer('antrian')->nullable();
            $table->integer('status_pemeriksaan')->nullable();
            $table->integer('status');
            $table->timestamps();

            $table->foreign('id_poli')->references('id')->on('poli');
            $table->foreign('id_pasien')->references('id')->on('pasien');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemeriksaan');
    }
}
