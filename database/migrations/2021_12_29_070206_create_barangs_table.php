<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->integer('stok')->default(0);
            $table->biginteger('satuan_id')->unsigned();
                    //foreign
                    $table->foreign('satuan_id')
                    ->references('id')
                    ->on('satuans');
            $table->biginteger('jenis_id')->unsigned();
                    //foreign
                    $table->foreign('jenis_id')
                    ->references('id')
                    ->on('jenis');
            $table->decimal('harga_beli', 15, 2)->nullable(); // Menambahkan kolom harga beli
            $table->decimal('harga_jual', 15, 2)->nullable(); // Menambahkan kolom harga jual
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
        Schema::dropIfExists('barangs');
    }
}