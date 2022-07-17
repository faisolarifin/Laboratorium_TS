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
        //master
        Schema::create('mast_admin', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('username');
            $table->string('password');
            $table->timestamps();
        });
        Schema::create('mast_setting', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('value');
        });
        //dosen
        Schema::create('mast_dosen', function (Blueprint $table) {
            $table->id('id_dosen');
            $table->string('nip', 20)->nullable();
            $table->string('nama', 100);
            $table->string('jabatan');
            $table->string('alamat', 100);
            $table->string('no_hp', 20);
            $table->string('email', 50);
            $table->timestamps();
        });
        //mahasiswa
        Schema::create('akun_mhs', function (Blueprint $table) {
            $table->id('id_mhs');
            $table->string('nama', 100);
            $table->string('nim', 20);
            $table->unique('nim');
            $table->string('password', 100);
            $table->string('alamat', 200)->nullable();
            $table->string('tmp_lahir', 40)->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('foto', 100)->nullable();
            $table->enum('status', ['non-aktif', 'aktif', 'block']);
            $table->timestamps();
        });

        //praktikum
        Schema::create('prak_matkul_praktikum', function (Blueprint $table) {
            $table->id('id_mp');
            $table->string('nama_mp',100);
            $table->decimal('harga', 12);
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        Schema::create('prak_periode', function (Blueprint $table) {
            $table->id('id_periode');
            $table->string('thn_ajaran', 50);
            $table->string('semester', 50);
            $table->timestamps();
        });

        //praktikum pendaftar
        Schema::create('prak_daftar_praktikum', function (Blueprint $table) {
            $table->id('id_daftarmp');
            $table->unsignedBigInteger('id_mhs');
            $table->foreign('id_mhs')->references('id_mhs')->on('akun_mhs')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->unsignedBigInteger('id_periode')->nullable();
            $table->foreign('id_periode')->references('id_periode')->on('prak_periode')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->enum('status_bayar', ['belum', 'lunas']);
            $table->enum('status_acc_fix', ['belum', 'terima']);
            $table->timestamps();
        });
        Schema::create('prak_daftar_praktikumd', function (Blueprint $table) {
            $table->unsignedBigInteger('id_daftarmp');
            $table->unsignedBigInteger('id_mp');
            $table->foreign('id_daftarmp')->references('id_daftarmp')->on('prak_daftar_praktikum')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('id_mp')->references('id_mp')->on('prak_matkul_praktikum')->onUpdate('CASCADE')->onDelete('CASCADE');
            
        });

        //praktikum acc
        Schema::create('prak_pendaftar_acc', function (Blueprint $table) {
            $table->id('id_daftar');
            $table->unsignedBigInteger('id_periode')->nullable();
            $table->foreign('id_periode')->references('id_periode')->on('prak_periode')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->unsignedBigInteger('id_mp');
            $table->foreign('id_mp')->references('id_mp')->on('prak_matkul_praktikum')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->enum('status_generate', ['0', '1']);
            $table->timestamps();
        });
        Schema::create('prak_pendaftar_accd', function (Blueprint $table) {
            $table->unsignedBigInteger('id_daftar');
            $table->unsignedBigInteger('id_mhs');
            $table->foreign('id_daftar')->references('id_daftar')->on('prak_pendaftar_acc')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('id_mhs')->references('id_mhs')->on('akun_mhs')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        //praktikum kelompok
        Schema::create('prak_kelompok', function (Blueprint $table) {
            $table->id('id_kel');
            $table->unsignedBigInteger('id_periode')->nullable();
            $table->foreign('id_periode')->references('id_periode')->on('prak_periode')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->unsignedBigInteger('id_mp');
            $table->foreign('id_mp')->references('id_mp')->on('prak_matkul_praktikum')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->string('nm_kel', 100);
            $table->date('tgl_ujian')->nullable();
            $table->unsignedBigInteger('pembimbing')->nullable();
            $table->unsignedBigInteger('penguji')->nullable();
            $table->foreign('pembimbing')->references('id_dosen')->on('mast_dosen')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('penguji')->references('id_dosen')->on('mast_dosen')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->timestamps();
        });
        Schema::create('prak_kelompokd', function (Blueprint $table) {
            $table->unsignedBigInteger('id_kel');
            $table->unsignedBigInteger('id_mhs');
            $table->foreign('id_kel')->references('id_kel')->on('prak_kelompok')->onUpdate('CASCADE')->onDelete('CASCADE');;
            $table->foreign('id_mhs')->references('id_mhs')->on('akun_mhs')->onUpdate('CASCADE')->onDelete('CASCADE');;
            $table->string('nilai', 10);
        });
        Schema::create('prak_jadwal', function (Blueprint $table) {
            $table->id('id_jadwal');
            $table->unsignedBigInteger('id_kel');
            $table->foreign('id_kel')->references('id_kel')->on('prak_kelompok')->onUpdate('CASCADE')->onDelete('CASCADE');
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
        Schema::dropIfExists('prak_jadwal');
        Schema::dropIfExists('prak_kelompokd');
        Schema::dropIfExists('prak_kelompok');
        Schema::dropIfExists('prak_pendaftar_accd');
        Schema::dropIfExists('prak_pendaftar_acc');
        Schema::dropIfExists('prak_daftar_praktikumd');
        Schema::dropIfExists('prak_daftar_praktikum');
        Schema::dropIfExists('prak_periode');
        Schema::dropIfExists('prak_matkul_praktikum');
        Schema::dropIfExists('akun_mhs');
        Schema::dropIfExists('mast_dosen');
        Schema::dropIfExists('mast_setting');
        Schema::dropIfExists('mast_admin');
    }
};
