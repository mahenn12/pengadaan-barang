<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class satuan extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'nama_satuan',
    ];

    public function barang()
    {
        return $this->hasMany(Barang::class, 'satuan_id');
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function($satuan) {
            //mengecek apakah satuan masih punya barang
            if ($satuan->barang->count() > 0) {
                //menyiapkan pesan error
                $html = 'Satuan tidak bisa di hapus karena memiliki barang: ';
                $html .= '<ul>';
                    foreach ($satuan->barang as $data) {
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
