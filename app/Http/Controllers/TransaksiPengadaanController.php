<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiPengadaan;
use App\Models\Barang;
use App\Models\Supplier;
use Illuminate\Support\Facades\Log;

class TransaksiPengadaanController extends Controller
{
    public function index()
    {
        // Fetch data for the procurement page
        $pengadaan = TransaksiPengadaan::all(); // Fetch all data
        Log::info('Data Transaksi Pengadaan:', ['data' => $pengadaan]);
        return view('admin.transaksi-pengadaan.index', compact('pengadaan'));
    }

    public function create()
    {
        $barang = Barang::all(); // Ambil semua data barang
        $suppliers = Supplier::all();
        return view('admin.transaksi-pengadaan.create', compact('barang', 'suppliers'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'kode_barang_masuk' => 'required|string',
            'tanggal_pengadaan' => 'required|date',
            'tanggal_permintaan' => 'required|date',
            'barang' => 'required|string',
            'pelanggan' => 'required|string',
            'jumlah_minta' => 'required|integer',
            'total' => 'required|numeric',
            'keterangan' => 'nullable|string',
            'status' => 'required|string',
            'bukti_acc' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image
        ]);

        // Handle file upload
        $buktiAccPath = null;
        if ($request->hasFile('bukti_acc')) {
            $file = $request->file('bukti_acc');
            $buktiAccPath = $file->store('uploads/bukti_acc', 'public'); // Store in public/uploads/bukti_acc
        }

        // Create a new TransaksiPengadaan record
        $transaksi = new TransaksiPengadaan();
        $transaksi->tanggal_pengadaan = $request->tanggal_pengadaan;
        $transaksi->tanggal_permintaan = $request->tanggal_permintaan;
        $transaksi->barang_id = $request->barang;
        $transaksi->pelanggan_id = $request->pelanggan;
        $transaksi->jumlah_minta = $request->jumlah_minta;
        $transaksi->total = $request->total; // Pastikan ini dihitung atau dikirim dari form
        $transaksi->keterangan = $request->keterangan;
        $transaksi->status = $request->status;
        $transaksi->bukti_acc = $request->file('bukti_acc')->store('public/bukti_acc');

        $transaksi->save();

        // Set flash message
        session()->flash('success', 'Data berhasil disimpan');

        // Redirect to the index page with a success message
        return redirect()->route('transaksi-pengadaan.index');
    }

    public function show($id)
    {
        // Logic to show a specific procurement entry
    }

    public function edit($id)
    {
        // Logic to edit a specific procurement entry
    }

    public function update(Request $request, $id)
    {
        // Logic to update a specific procurement entry
    }

    public function destroy($id)
    {
        // Logic to delete a specific procurement entry
    }
}