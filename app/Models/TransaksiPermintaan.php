<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPermintaan extends Model
{
    use HasFactory;

    protected $table = 'transaksi_permintaan';

    protected $fillable = [
        'tgl_permintaan',
        'barang_id',
        'jumlah_minta',
        'total',
        'pelanggan',
        'keterangan',
        'status_permintaan',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'pelanggan');
    }
}
