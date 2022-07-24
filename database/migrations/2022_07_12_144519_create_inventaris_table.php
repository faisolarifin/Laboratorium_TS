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
        Schema::create('inve_alat_bahan', function (Blueprint $table) {
            $table->char('serial_num', 6)->primary();
            $table->string('item_name' ,100)->nullable();
            $table->string('vendor',100)->nullable();
            $table->string('catalog',100)->nullable();
            $table->string('owner',100)->nullable();
            $table->string('location',100)->nullable();
            $table->string('sub_loc',100)->nullable();
            $table->string('loc_detail',100)->nullable();
            $table->decimal('price')->nullable();
            $table->integer('amount_ins')->nullable();
            $table->string('unit_size', 30)->nullable();
            $table->text('url')->nullable();
            $table->text('tech_detail')->nullable();
            $table->date('expired_date')->nullable();
            $table->integer('lot_num')->nullable();
            $table->integer('cas_num')->nullable();
            $table->string('cont_person')->nullable();
            $table->string('cont_phone')->nullable();
            $table->date('install_date')->nullable();
            $table->date('publish_date')->nullable();
            $table->string('mntc_hist', 100)->nullable();
            $table->string('serial', 100)->nullable();
            $table->string('univ_tag', 100)->nullable();
            $table->timestamps();
        });

        Schema::create('inve_permohonan', function (Blueprint $table) {
            $table->id();
            $table->string('item_name', 100)->nullable();
            $table->string('req_by', 100)->nullable();
            $table->string('lab_name', 100)->nullable();
            $table->string('vendor', 100)->nullable();
            $table->string('catalog', 100)->nullable();
            $table->string('type', 100)->nullable();
            $table->string('spend_track', 100)->nullable();
            $table->string('other_detail', 100)->nullable();
            $table->integer('qty')->nullable();
            $table->string('unit_size', 30)->nullable();
            $table->text('url')->nullable();
            $table->double('unit_price')->nullable();
            $table->string('shipping')->nullable();
            $table->string('po', 100)->nullable();
            $table->string('req', 100)->nullable();
            $table->string('confirm', 100)->nullable();
            $table->string('invoice', 100)->nullable();
            $table->string('tracking', 100)->nullable();
            $table->string('bought', 100)->nullable();
            $table->string('status', 30)->nullable();
            $table->date('req_date')->nullable();
            $table->date('approv_date')->nullable();
            $table->string('appove_by', 100)->nullable();
            $table->string('appove_msg', 100)->nullable();
            $table->date('order_date')->nullable();
            $table->string('order_by', 100)->nullable();
            $table->string('order_msg', 100)->nullable();
            $table->date('cancel_date')->nullable();
            $table->string('cencel_by', 100)->nullable();
            $table->string('cencel_msg', 100)->nullable();
            $table->date('backorder_date')->nullable();
            $table->date('backorder_exp_date')->nullable();
            $table->string('backorder_by', 100)->nullable();
            $table->string('backorder_msg', 100)->nullable();
            $table->date('receiv_date')->nullable();
            $table->string('receiv_by', 100)->nullable();
            $table->string('receiv_msg', 100)->nullable();
            $table->string('notes', 100)->nullable();
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
        Schema::dropIfExists('inve_permohonan');
        Schema::dropIfExists('inve_alat_bahan');
    }
};
