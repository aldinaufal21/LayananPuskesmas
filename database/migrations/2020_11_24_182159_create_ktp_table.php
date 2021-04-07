<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKtpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ktp', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('foto');
            $table->unsignedBigInteger('id_pasien');
            $table->timestamps();

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
        Schema::dropIfExists('ktp');
    }
}
