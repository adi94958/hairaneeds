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
        Schema::create('database_pembelian', function (Blueprint $table) {
            $table->string('kode_transaksi')->primary();
            $table->date('tanggal_transaksi');
            $table->string('kode_vendor');
            $table->foreign('kode_vendor')->references('kode_vendor')->on('database_vendor');
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
        Schema::dropIfExists('database_pembelian');
    }
};
