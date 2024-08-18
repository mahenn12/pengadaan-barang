<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class BarangMasuk extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'kode_barang_masuk',
        'tanggal_masuk',
        'supplier_id',
        'barang_id',
        'qty',
        'user_id',
    ];
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public static function kode()
    {
        $kode = DB::table('barang_masuks')->max('kode_barang_masuk');
        $addNol = '';
        $kode = str_replace("BRG-MSK", "", $kode);
        $kode = (int) $kode + 1;
        $incrementKode = $kode;

        if (strlen($kode) == 1)
        {
            $addNol = "000";
        }
        else if (strlen($kode) == 2)
        {
            $addNol = "00";
        }
        else if (strlen($kode) == 3)
        {
            $addNol = "0";
        }

        $kodeBaru = "BRG-MSK".$addNol.$incrementKode;
        return $kodeBaru;
    }
}
