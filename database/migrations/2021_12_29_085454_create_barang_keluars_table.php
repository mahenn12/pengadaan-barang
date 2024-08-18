<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangKeluarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_keluars', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang_keluar');
            $table->date('tanggal_keluar');
            $table->biginteger('barang_id')->unsigned();
                    //foreign
                    $table->foreign('barang_id')
                    ->references('id')
                    ->on('barangs');
            $table->integer('qty');
            $table->biginteger('user_id')->unsigned();
                    //foreign
                    $table->foreign('user_id')
                    ->references('id')
                    ->on('users');
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
        Schema::dropIfExists('barang_keluars');
    }
}
