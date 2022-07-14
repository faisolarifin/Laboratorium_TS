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
            $table->string('item_name', 100);
            $table->string('req_by', 100);
            $table->string('lab_name', 100);
            $table->string('vendor', 100);
            $table->string('catalog', 100);
            $table->string('type', 100);
            $table->string('spend_track', 100);
            $table->string('other_detail', 100);
            $table->integer('qty');
            $table->string('unit_size', 30);
            $table->text('url');
            $table->double('unit_price');
            $table->double('total_price');
            $table->string('shipping');
            $table->string('po', 100);
            $table->string('req', 100);
            $table->string('confirm', 100);
            $table->string('invoce', 100);
            $table->string('tracking', 100);
            $table->string('bought', 100);
            $table->string('status', 30);
            $table->date('req_date');
            $table->date('approv_date');
            $table->string('appove_by', 100);
            $table->string('appove_msg', 100);
            $table->date('order_date');
            $table->string('order_by', 100);
            $table->string('order_msg', 100);
            $table->date('cancel_date');
            $table->string('cencel_by', 100);
            $table->string('cencel_msg', 100);
            $table->date('backorder_date');
            $table->string('backorder_by', 100);
            $table->string('backorder_msg', 100);
            $table->date('receiv_date');
            $table->string('receiv_by', 100);
            $table->string('receiv_msg', 100);
            $table->string('notes', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventaris');
    }
};
