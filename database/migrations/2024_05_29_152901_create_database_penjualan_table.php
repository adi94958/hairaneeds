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
        Schema::create('database_penjualan', function (Blueprint $table) {
            $table->string('kode_transaksi')->primary();
            $table->date('tanggal_transaksi');
            $table->string('kode_customer');
            $table->foreign('kode_customer')->references('kode_customer')->on('database_customer');
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
        Schema::dropIfExists('database_penjualan');
    }
};
