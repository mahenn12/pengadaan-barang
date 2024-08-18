<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\TransaksiPermintaan;
use App\Models\Barang;
use App\Models\Supplier;

class TransaksiPermintaanController extends Controller
{
    public function index()
    {
        $permintaan = TransaksiPermintaan::all(); // Ambil semua data transaksi
        return view('admin.transaksi-permintaan.index', compact('permintaan'));
    }

    public function create()
    {
        $barang = Barang::all(); // Ambil semua data barang
        $suppliers = Supplier::all();
        return view('admin.transaksi-permintaan.create', compact('barang', 'suppliers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal_permintaan' => 'required|date_format:Y-m-d', // Ubah format di sini
            'barang' => 'required|exists:barangs,id',
            // 'harga_jual' => 'required|string', // Validasi harga jual
            'jumlah_minta' => 'required|integer',
            // 'total' => 'required|numeric', // Validasi total
            'pelanggan' => 'required|exists:suppliers,id',
            'keterangan' => 'nullable|string',
            'status_permintaan' => 'required|string|max:255',
        ], [
            'harga_jual.numeric' => 'Harga jual harus berupa angka yang valid.',
            'total.numeric' => 'Total harus berupa angka yang valid.',
        ]);

        // Ubah format tanggal
        // $tgl_permintaan = Carbon::createFromFormat('d-m-Y', $request->tgl_permintaan)->format('Y-m-d');

        // Ubah format total menjadi angka
        // $total = str_replace(['Rp ', '.', ','], ['', '', '.'], $request->total); // Menghapus 'Rp ', titik, dan mengganti koma dengan titik

        $validated['tgl_permintaan'] = $request->tanggal_permintaan;
        $validated['barang_id'] = $request->barang;
        $validated['total'] = Barang::findOrFail($request->barang)->harga_jual * $request->jumlah_minta;

        unset(
            $validated['tanggal_permintaan'],
            $validated['barang'],
        );
        // Simpan data
        TransaksiPermintaan::create($validated);

        return redirect()->route('transaksi-permintaan.create')->with('success', 'Data berhasil ditambahkan.');
    }

    public function show($id)
    {
        // Logic to show a specific transaction
    }

    public function edit($id)
    {
        // Logic to show the edit form
    }

    public function update(Request $request, $id)
    {
        // Logic to update the transaction
    }

    public function destroy($id)
    {
        // Logic to delete the transaction
    }
}
