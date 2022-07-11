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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('akun_mhs');
    }
};
