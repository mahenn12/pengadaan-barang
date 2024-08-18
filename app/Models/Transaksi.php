<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    public function barang()
    {
        return $this->belongsTo('App\Models\Barang', 'nama_barang');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'pelaku');
    }   
}
