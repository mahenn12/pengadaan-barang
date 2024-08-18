<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Satuan;
use App\Models\Jenis;
use Illuminate\Http\Request;
use Session;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::all();
        return view('admin.barang.index', compact('barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kode = Barang::kode();
        $jenis = Jenis::all();
        $satuan = Satuan::all();
        return view('admin.barang.create', compact('kode','jenis','satuan'));
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
            'nama_barang' => 'required',
            'jenis_id' => 'required',
            'satuan_id' => 'required',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
        ]);
        $barang = new Barang();
        $barang->kode_barang = $request->kode_barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->jenis_id = $request->jenis_id;
        $barang->satuan_id = $request->satuan_id;
        $barang->harga_beli = $request->harga_beli;
        $barang->harga_jual = $request->harga_jual;
        $barang->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menyimpan barang $barang->nama_barang"
        ]);


        return redirect()->route('barang.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $kode = Barang::kode();        
        $jenis = Jenis::all();
        $satuan = Satuan::all();
        return view('admin.barang.edit', compact('barang','kode','jenis','satuan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_barang' => 'required',
            'jenis_id' => 'required',
            'satuan_id' => 'required',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->kode_barang = $request->kode_barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->jenis_id = $request->jenis_id;
        $barang->satuan_id = $request->satuan_id;
        $barang->harga_beli = $request->harga_beli;
        $barang->harga_jual = $request->harga_jual;
        $barang->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil mengedit Barang $barang->nama_barang"
        ]);

        return redirect()->route('barang.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        
        if(!Barang::destroy($id)) {
            return redirect()->back();
        } else {
            Session::flash("flash_notification", [
                "level" => "success",
                "message" => "Berhasil menghapus barang $barang->nama_barang"
            ]);
            return redirect()->route('barang.index');
        }

        $barang->delete();
    }
}