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
        Schema::create('sewa_alat', function (Blueprint $table) {
            $table->id('id_alat');
            $table->string('nm_alat', 100);
            $table->decimal('biaya_umum');
            $table->decimal('biaya_khusus');
            $table->integer('jumlah');
            $table->string('kondisi', 100);
            $table->timestamps();
        });
        Schema::create('sewa_penyewaan', function (Blueprint $table) {
            $table->id('id_sewa');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->unsignedBigInteger('id_alat');
            $table->foreign('id_alat')->references('id_alat')->on('sewa_alat')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->date('tgl_permohonan');
            $table->date('tgl_sewa')->nullable();
            $table->date('tgl_kembali')->nullable();
            $table->integer('jumlah')->nullable();
            $table->enum('keperluan', ['praktikum', 'pengujian', 'peminjaman']);
            $table->enum('status', ['permohonan', 'sewa', 'selesai']);
            $table->decimal('total_biaya')->nullable();
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
        Schema::dropIfExists('sewa_penyewaan');
        Schema::dropIfExists('sewa_alat');
    }
};
