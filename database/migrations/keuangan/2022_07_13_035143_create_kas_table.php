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
        Schema::create('keu_kas_periode', function (Blueprint $table) {
            $table->id('id_kasp');
            $table->unsignedBigInteger('id_periode');
            $table->foreign('id_periode')->references('id_periode')->on('prak_periode');
            $table->decimal('saldo_awal', 12);
            $table->decimal('sisa_saldo', 12);
            $table->string('ket', 100);
            $table->timestamps();
        });
        Schema::create('keu_kode_kas', function (Blueprint $table) {
            $table->id();
            $table->string('nm_kode', 10);
            $table->decimal('harga');
            $table->string('ket', 100);
            $table->timestamps();
        });
        Schema::create('keu_kas', function (Blueprint $table) {
            $table->id('id_kas');
            $table->unsignedBigInteger('id_kasp');
            $table->foreign('id_kasp')->references('id_kasp')->on('keu_kas_periode');
            $table->unsignedBigInteger('id_kode');
            $table->foreign('id_kode')->references('id')->on('keu_kode_kas');
            $table->date('tgl');
            $table->text('nama');
            $table->decimal('harga', 12);
            $table->integer('jumlah');
            $table->enum('tipe', ['kredit', 'debit']);
            $table->decimal('total', 12);
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
        Schema::dropIfExists('keu_kas_periode');
        Schema::dropIfExists('keu_kode_kas');
        Schema::dropIfExists('keu_saldo');
    }
};
