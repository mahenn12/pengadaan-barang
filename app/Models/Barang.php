<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;
use DB;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Barang extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'kode_barang',
        'nama_barang',
        'jenis_id',
        'satuan_id',
        'harga_beli',
        'harga_jual',
    ];

    protected function hargaJualNumeric(): Attribute
    {
        return Attribute::get(fn() => round($this->harga_jual, 0));
    }

    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'jenis_id');
    }
    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id');
    }
    public function barangmasuk()
    {
        return $this->hasMany(BarangMasuk::class, 'barang_id');
    }
    public function barangkeluar()
    {
        return $this->hasMany(BarangKeluar::class, 'barang_id');
    }
    public function transaksi()
    {
        return $this->hasMany('App\Models\Transaksi', 'nama_barang');
    }


    public static function kode()
    {
        $kode = DB::table('barangs')->max('kode_barang');
        $addNol = '';
        $kode = str_replace("BRG", "", $kode);
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

        $kodeBaru = "BRG".$addNol.$incrementKode;
        return $kodeBaru;
    }

    public static function boot() {
    parent::boot();
        self::deleting(function($barang) {
            //mengecek apakah barang masih punya barang
            if ($barang->barangmasuk->count() > 0) {
                //menyiapkan pesan error
                $html = 'barang tidak bisa di hapus karena memiliki kode_barang: ';
                $html .= '<ul>';
                    foreach ($barang->barangmasuk as $data) {
                        $html .= "<li>$data->kode_barang_masuk</li>";
                    }
                    $html .= '</ul>';
                Session::flash("flash_notification", [
                    "level" => "danger",
                    "message" => $html
                ]);
                //membatalkan proses penghapusan
                return false;
            }
        });

    }
}
