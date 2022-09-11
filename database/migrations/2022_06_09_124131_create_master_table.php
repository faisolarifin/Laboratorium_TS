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
        Schema::create('tbl_setting', function (Blueprint $table) {
            $table->id();
            $table->string('dekan', 100)->nullable();
            $table->string('kaprodi', 100)->nullable();
            $table->string('kalab', 100)->nullable();
            $table->string('periode_aktif', 10)->nullable();
            $table->enum('praktikum', ['on', 'off'])->nullable();
        });
        //dosen
        Schema::create('tbl_dosen', function (Blueprint $table) {
            $table->id('id_dosen');
            $table->string('nidn', 20)->nullable();
            $table->string('nama', 100);
            $table->string('jabatan');
            $table->string('alamat', 100);
            $table->string('no_hp', 20);
            $table->string('email', 50);
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
        Schema::dropIfExists('tbl_setting');
        Schema::dropIfExists('tbl_dosen');
    }
};
