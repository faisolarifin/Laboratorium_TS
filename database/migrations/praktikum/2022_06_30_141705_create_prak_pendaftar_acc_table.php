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
        Schema::create('prak_pendaftar_acc', function (Blueprint $table) {
            $table->id('id_daftar');
            $table->unsignedBigInteger('id_periode');
            $table->unsignedBigInteger('id_mp');
            $table->foreign('id_periode')->references('id_periode')->on('prak_periode');
            $table->foreign('id_mp')->references('id_mp')->on('prak_matkul_praktikum');
            $table->enum('status_generate', ['0', '1']);
            $table->timestamps();
        });
        Schema::create('prak_pendaftar_accd', function (Blueprint $table) {
            $table->unsignedBigInteger('id_daftar');
            $table->unsignedBigInteger('id_mhs');
            $table->foreign('id_daftar')->references('id_daftar')->on('prak_pendaftar_acc');
            $table->foreign('id_mhs')->references('id_mhs')->on('akun_mhs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prak_pendaftar_accd');
        Schema::dropIfExists('prak_pendaftar_acc');
    }
};
