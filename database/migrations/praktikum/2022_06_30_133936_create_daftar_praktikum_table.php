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
        Schema::create('prak_daftar_praktikum', function (Blueprint $table) {
            $table->id('id_daftarmp');
            $table->unsignedBigInteger('id_mhs');
            $table->unsignedBigInteger('id_periode');
            $table->foreign('id_mhs')->references('id_mhs')->on('akun_mhs');
            $table->foreign('id_periode')->references('id_periode')->on('prak_periode');
            $table->enum('status_bayar', ['belum', 'lunas']);
            $table->enum('status_acc_fix', ['belum', 'terima']);
            $table->timestamps();
        });
        Schema::create('prak_daftar_praktikumd', function (Blueprint $table) {
            $table->unsignedBigInteger('id_daftarmp');
            $table->unsignedBigInteger('id_mp');
            $table->foreign('id_daftarmp')->references('id_daftarmp')->on('prak_daftar_praktikum');
            $table->foreign('id_mp')->references('id_mp')->on('prak_matkul_praktikum');
            
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prak_daftar_praktikumd');
        Schema::dropIfExists('prak_daftar_praktikum');
    }
};
