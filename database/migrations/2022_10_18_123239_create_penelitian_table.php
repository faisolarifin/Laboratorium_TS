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
        Schema::create('pgj_pengujian', function (Blueprint $table) {
            $table->id('id_pgj');
            $table->string('nm_kategori', 100);
            $table->string('nm_pengujian', 100);
            $table->timestamps();
        });
        Schema::create('pgj_percobaan', function (Blueprint $table) {
            $table->id('id_percobaan');
            $table->unsignedBigInteger('id_pgj');
            $table->foreign('id_pgj')->references('id_pgj')->on('pgj_pengujian')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->string('nm_percobaan', 100);
            $table->timestamps();
        });
        Schema::create('plt_permohonan', function (Blueprint $table) {
            $table->id('id_pmh');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->date('tgl_permohonan');
            $table->string('proposal', 100)->nullable();
            $table->string('srt_permohonan', 100)->nullable();
            $table->string('link_formulir')->nullable();
            $table->enum('status', ['permohonan', 'diterima', 'ditolak']);
            $table->timestamps();
        });
        Schema::create('plt_penelitian', function (Blueprint $table) {
            $table->id('id_plt');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->date('tgl_daftar');
            $table->decimal('total_bayar')->nullable();
            $table->string('laporan')->nullable();
            $table->string('dikirim_oleh')->nullable();
            $table->string('diterima_oleh')->nullable();
            $table->timestamps();
        });
        Schema::create('plt_daftar_percobaan', function (Blueprint $table) {
            $table->unsignedBigInteger('id_plt');
            $table->foreign('id_plt')->references('id_plt')->on('plt_penelitian')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->unsignedBigInteger('id_percobaan');
            $table->foreign('id_percobaan')->references('id_percobaan')->on('pgj_percobaan')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->integer('jml_percobaan')->nullable();
            $table->decimal('total_biaya')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plt_daftar_percobaan');
        Schema::dropIfExists('plt_penelitian');
        Schema::dropIfExists('plt_permohonan');
        Schema::dropIfExists('pgj_percobaan');
        Schema::dropIfExists('pgj_pengujian');
    }
};
