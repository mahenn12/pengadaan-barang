<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Supplier;
use App\Models\Barang;
use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Session;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $masuk = BarangMasuk::all();
        return view('admin.barang-masuk.index', compact('masuk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kode = BarangMasuk::kode();
        $supplier = Supplier::all();
        $barang = Barang::all();
        $user = User::all();
        return view('admin.barang-masuk.create', compact('kode','supplier','barang','user'));
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
            'tanggal_masuk' => 'required',
            'supplier_id' => 'required',
            'barang_id' => 'required',
            'qty' => 'required',
            'user_id' => 'required',
        ]);
        $masuk = new BarangMasuk();
        if($request->qty >= 0){
        $masuk->kode_barang_masuk = $request->kode_barang_masuk;
        $masuk->tanggal_masuk = $request->tanggal_masuk;
        $masuk->supplier_id = $request->supplier_id;
        $masuk->barang_id = $request->barang_id;
        $masuk->qty = $request->qty;
        $masuk->user_id = $request->user_id;
        $masuk->save();
        }
        elseif($request->qty < 0){
            Session::flash("flash_notification", [
                "level" => "danger",
                "message" => "Stok Tidak Boleh Negatif"
            ]);
            return redirect()->back();
        }

        $barang = Barang::where('id', $masuk->barang_id)->first();
        $barang->stok += $request->qty;
        $barang->save();

        $transaksi = new Transaksi();
        $transaksi->jenis = 'Barang Masuk';
        $transaksi->tanggal_transaksi = $masuk->tanggal_masuk;
        $transaksi->nama_barang = $masuk->barang_id;
        $transaksi->qty = $masuk->qty;
        $transaksi->pelaku = $masuk->user_id;
        $transaksi->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menyimpan barang masuk $barang->nama_barang"
        ]);

        return redirect()->route('barang-masuk.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function show(BarangMasuk $barangMasuk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kode = BarangMasuk::kode();
        $supplier = Supplier::all();
        $barang = Barang::all();
        $masuk = BarangMasuk::findOrFail($id);
        $user = User::all();
        return view('admin.barang-masuk.edit', compact('barang','kode','supplier','masuk','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal_masuk' => 'required',
            'supplier_id' => 'required',
            'barang_id' => 'required',
            'qty' => 'required',
            'user_id' => 'required',
        ]);
        $old = BarangMasuk::findOrFail($id);

        $masuk = BarangMasuk::findOrFail($id);
        $barang = Barang::where('id', $masuk->barang_id)->first();
        $masuk->kode_barang_masuk = $request->kode_barang_masuk;
        $masuk->tanggal_masuk = $request->tanggal_masuk;
        $masuk->supplier_id = $request->supplier_id;
        $masuk->barang_id = $request->barang_id;
        $masuk->qty = $request->qty;
        $masuk->user_id = $request->user_id;
        //hitung stok tabel barang
        $barang->stok -= $old->qty;
        $barang->stok += $request->qty;
        $barang->save();
        //save edit
        $masuk->save();

        return redirect()->route('barang-masuk.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $barangMasuk = BarangMasuk::findOrFail($id);
            $barang = Barang::where('id', $barangMasuk->barang_id)->first();
            $barang->stok -= $barangMasuk->qty;
            $barang->save();
            $barangMasuk->delete();

            Session::flash("flash_notification", [
                "level" => "success",
                "message" => "Berhasil menghapus data barang masuk"
                ]);
            return redirect()->route('barang-masuk.index');
    }
}
