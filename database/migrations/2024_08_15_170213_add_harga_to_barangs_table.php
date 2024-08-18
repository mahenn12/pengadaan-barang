<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHargaToBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('barangs', function (Blueprint $table) {
            // $table->decimal('harga_beli', 15, 2)->nullable(); // Menambahkan kolom harga beli
            // $table->decimal('harga_jual', 15, 2)->nullable(); // Menambahkan kolom harga jual
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('barangs', function (Blueprint $table) {
            // $table->dropColumn(['harga_beli', 'harga_jual']);
        });
    }
}
