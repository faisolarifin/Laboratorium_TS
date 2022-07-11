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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin');
    }
};
