<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\Barang;
use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Session;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keluar = BarangKeluar::all();
        return view('admin.barang-keluar.index', compact('keluar'));
    }

    public function cetakBk()
    {
        $keluar = BarangKeluar::all();
        $pdf   = \PDF::loadview('admin.cetak-laporan.cetak-bk', ['keluar' => $keluar]);
        return $pdf->download('laporan-barang-keluar.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kode = BarangKeluar::kode();
        $barang = Barang::all();
        $user = User::all();
        return view('admin.barang-keluar.create', compact('kode','barang','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal_keluar' => 'required',
            'barang_id' => 'required',
            'qty' => 'required',
            'user_id' => 'required',
        ]);

        $barang = Barang::findOrFail($request->barang_id);
        if($request->qty > $barang->stok){
            Session::flash("flash_notification", [
                "level" => "danger",
                "message" => "Stok Kurang"
                ]);
                return redirect()->route('barang-keluar.index');
            }
        elseif($request->qty < 0){
            Session::flash("flash_notification", [
                "level" => "danger",
                "message" => "Qty Tidak Boleh Negatif"
            ]);
            return redirect()->back();
        }
        else{
            $keluar = new BarangKeluar();
            $keluar->kode_barang_keluar = $request->kode_barang_keluar;
            $keluar->tanggal_keluar = $request->tanggal_keluar;
            $keluar->barang_id = $request->barang_id;
            $keluar->qty = $request->qty;
            $keluar->user_id = $request->user_id;
            $keluar->save();
            $barang->stok -= $request->qty;
            $barang->save();
        }

        $transaksi = new Transaksi();
        $transaksi->jenis = 'Barang Keluar';
        $transaksi->tanggal_transaksi = $keluar->tanggal_keluar;
        $transaksi->nama_barang = $keluar->barang_id;
        $transaksi->qty = $keluar->qty;
        $transaksi->pelaku = $keluar->user_id;
        $transaksi->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menyimpan barang keluar"
        ]);

        return redirect()->route('barang-keluar.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BarangKeluar  $barangKeluar
     * @return \Illuminate\Http\Response
     */
    public function show(BarangKeluar $barangKeluar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BarangKeluar  $barangKeluar
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kode = BarangKeluar::kode();
        $barang = Barang::all();
        $user = User::all();
        $keluar = BarangKeluar::findOrFail($id);
        return view('admin.barang-keluar.edit', compact('kode','keluar','barang','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BarangKeluar  $barangKeluar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal_keluar' => 'required',
            'barang_id' => 'required',
            'qty' => 'required',
            'user_id' => 'required',
        ]);

        $old = BarangKeluar::findOrFail($id);

        $keluar = BarangKeluar::findOrFail($id);
        $barang = Barang::where('id', $keluar->barang_id)->first();
        $keluar->kode_barang_keluar = $request->kode_barang_keluar;
        $keluar->tanggal_keluar = $request->tanggal_keluar;
        $keluar->barang_id = $request->barang_id;
        $keluar->qty = $request->qty;
        $keluar->user_id = $request->user_id;
        //hitung stok tabel barang
        $barang->stok += $old->qty;
        $barang->stok -= $request->qty;
        $barang->save();
        //save edit
        $keluar->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil mengedit barang keluar $barang->nama_barang"
        ]);
        return redirect()->route('barang-keluas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BarangKeluar  $barangKeluar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barangKeluar = BarangKeluar::findOrFail($id);
            $barang = Barang::where('id', $barangKeluar->barang_id)->first();
            $barang->stok += $barangKeluar->qty;
            $barang->save();

            $barangKeluar->delete();
            Session::flash("flash_notification", [
                "level" => "success",
                "message" => "Berhasil menghapus data barang keluar"
                ]);
            return redirect()->route('barang-keluar.index');
    }
}
