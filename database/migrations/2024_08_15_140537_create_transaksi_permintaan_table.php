<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiPermintaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_permintaan', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_permintaan');
            $table->biginteger('barang_id')->unsigned();
            $table->integer('jumlah_minta');
            $table->decimal('total', 15, 2);
            $table->string('pelanggan');
            $table->string('keterangan')->nullable();
            $table->string('status_permintaan');
            $table->timestamps();

            // Foreign key
            $table->foreign('barang_id')->references('id')->on('barangs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_permintaan');
    }
}