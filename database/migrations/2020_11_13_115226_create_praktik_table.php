<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePraktikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('praktik', function (Blueprint $table) {
            $table->id();
            $table->dateTime('mulai', 0);
            $table->dateTime('berakhir', 0);
            $table->unsignedBigInteger('id_dokter');
            $table->timestamps();

            $table->foreign('id_dokter')->references('id')->on('dokter');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('praktik');
    }
}
