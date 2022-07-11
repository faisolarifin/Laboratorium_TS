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
        Schema::create('prak_kelompok', function (Blueprint $table) {
            $table->id('id_kel');
            $table->unsignedBigInteger('id_periode');
            $table->unsignedBigInteger('id_mp');
            $table->foreign('id_periode')->references('id_periode')->on('prak_periode');
            $table->foreign('id_mp')->references('id_mp')->on('prak_matkul_praktikum');
            $table->string('nm_kel', 100);
            $table->date('tgl_ujian')->nullable();
            $table->unsignedBigInteger('pembimbing')->nullable();
            $table->unsignedBigInteger('penguji')->nullable();
            $table->foreign('pembimbing')->references('id_dosen')->on('mast_dosen');
            $table->foreign('penguji')->references('id_dosen')->on('mast_dosen');
            $table->timestamps();
        });
        Schema::create('prak_kelompokd', function (Blueprint $table) {
            $table->unsignedBigInteger('id_kel');
            $table->unsignedBigInteger('id_mhs');
            $table->foreign('id_kel')->references('id_kel')->on('prak_kelompok');
            $table->foreign('id_mhs')->references('id_mhs')->on('akun_mhs');
            $table->string('nilai', 10);
        });
        Schema::create('prak_jadwal', function (Blueprint $table) {
            $table->id('id_jadwal');
            $table->unsignedBigInteger('id_kel');
            $table->foreign('id_kel')->references('id_kel')->on('prak_kelompok');
            $table->date('tgl_prak');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prak_kelompokd');
        Schema::dropIfExists('prak_kelompok');
    }
};
