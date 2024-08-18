<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class TransaksiPengadaan extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'transaksi_pengadaan';
    protected $fillable = [
        'tanggal_pengadaan', 
        'tanggal_permintaan', 
        'barang_id', 
        'pelanggan_id',
        'jumlah_minta', 
        'total', 'keterangan', 
        'status', 'bukti_acc'
    ];

    public function transaksiPengadaan()
    {
        return $this->belongsTo(TransaksiPengadaan::class, 'transaksi_pengadaan_id');
    }
}