<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class Jenis extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'nama_jenis',
    ];

    public function barang()
    {
        return $this->hasMany(Barang::class, 'jenis_id');
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function($jenis) {
            //mengecek apakah jenis masih punya barang
            if ($jenis->barang->count() > 0) {
                //menyiapkan pesan error
                $html = 'Jenis tidak bisa di hapus karena memiliki barang : ';
                $html .= '<ul>';
                    foreach ($jenis->barang as $data) {
                        $html .= "<li>$data->nama_barang</li>";
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
