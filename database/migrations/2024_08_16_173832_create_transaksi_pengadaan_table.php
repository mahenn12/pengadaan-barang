<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiPengadaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_pengadaan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_pengadaan');
            $table->date('tanggal_permintaan');
            $table->unsignedBigInteger('barang_id');
            $table->unsignedBigInteger('pelanggan_id');
            $table->integer('jumlah_minta');
            $table->decimal('total', 8, 2);
            $table->string('keterangan')->nullable();
            $table->string('status');
            $table->string('bukti_acc')->nullable();
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
        Schema::dropIfExists('transaksi_pengadaan');
    }
}