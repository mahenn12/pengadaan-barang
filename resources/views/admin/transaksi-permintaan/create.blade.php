@extends('layouts.app')

@section('header')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                <em class="fa fa-home"></em>
            </a></li>
            <li class="active">Form Input Transaksi Permintaan</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Form Input Transaksi Permintaan</h1>
        </div>
    </div><!--/.row-->
@endsection

@section('content')
<div class="panel panel-default col-md-12">
    <div class="panel-heading"> Form Input Transaksi Permintaan
        <a href="{{ route('transaksi-permintaan.index') }}" class="btn btn-default" style="float: right;"><span class="fa fa-arrow-left">&nbsp;</span> Kembali</a>
    </div>
    <div class="panel-body">
        <div class="col-md-12">
            <form role="form" action="{{ route('transaksi-permintaan.store') }}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="form-group">
                    <label>Tanggal Permintaan</label>
                    <input type="date" class="form-control" id="tanggal_permintaan" name="tanggal_permintaan" required placeholder="Pilih tanggal permintaan">
                </div>
                <div class="form-group">
                    <label>Barang</label>
                    <select class="form-control" id="barang" name="barang" required onchange="updateHarga()">
                        <option value="">Pilih Barang</option>
                        @foreach ($barang as $barang)
                            <option value="{{ $barang->id }}" data-harga="{{ $barang->harga_jual }}">{{ $barang->nama_barang }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Harga Jual/Satuan</label>
                    <input type="text" class="form-control" id="harga_jual_satuan" name="harga_jual_satuan" readonly>
                </div>
                <div class="form-group">
                    <label>Pelanggan</label>
                    <select class="form-control" id="pelanggan" name="pelanggan" required>
                        <option value="">Pilih Pelanggan</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->nama_supplier }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Jumlah Minta</label>
                    <input type="number" class="form-control" id="jumlah_minta" name="jumlah_minta" required oninput="updateTotal()" min="0">
                </div>
                <div class="form-group">
                    <label>Total Permintaan</label>
                    <input type="text" class="form-control" id="total_permintaan" name="total_permintaan" readonly>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                </div>
                <div class="form-group">
                    <label>Status Permintaan</label>
                    <select class="form-control" id="status_permintaan" name="status_permintaan" required>
                        <option value="">Pilih Status</option>
                        <option value="Sedang diproses">Sedang diproses</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                    <button class="btn btn-default" type="reset">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<script>
    function updateHarga() {
        var select = document.getElementById("barang");
        var harga = select.options[select.selectedIndex].getAttribute("data-harga") || 0;
        // Format the price as a currency string
        var formattedHarga = "Rp " + parseFloat(harga).toLocaleString('id-ID');
        document.getElementById("harga_jual_satuan").value = formattedHarga;
        updateTotal(); // Call updateTotal to recalculate if there's already a quantity entered
    }

    function updateTotal() {
        var hargaStr = document.getElementById("harga_jual_satuan").value;
        // Remove the "Rp " prefix and convert to number for calculation
        var harga = parseFloat(hargaStr.replace("Rp ", "").replace(/\./g, '').replace(/,/g, '.'));
        var jumlah = parseInt(document.getElementById("jumlah_minta").value) || 0;
        var total = harga * jumlah;
        // Format the total as a currency string
        document.getElementById("total_permintaan").value = "Rp " + total.toLocaleString('id-ID');
    }

    // Debugging: Log values to console to check if they are being retrieved correctly
    document.getElementById("barang").addEventListener('change', function() {
        console.log("Selected harga:", document.getElementById("harga_jual_satuan").value);
    });
    document.getElementById("jumlah_minta").addEventListener('input', function() {
        console.log("Calculated total:", document.getElementById("total_permintaan").value);
    });
</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("#tanggal_permintaan", {
        enableTime: false,
        dateFormat: "d-m-Y",
        altInput: true,
        altFormat: "F j, Y",
        allowInput: false
    });
</script>