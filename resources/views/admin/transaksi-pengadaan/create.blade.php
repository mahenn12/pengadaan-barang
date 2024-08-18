@extends('layouts.app')

@section('header')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                <em class="fa fa-home"></em>
            </a></li>
            <li class="active">Transaksi Pengadaan</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Form Input Transaksi Pengadaan</h1>
        </div>
    </div><!--/.row-->
@endsection

@section('content')
<div class="panel panel-default col-md-12">
    <div class="panel-heading"> Form Input Transaksi Pengadaan
        <a href="{{ route('transaksi-pengadaan.index') }}" class="btn btn-default" style="float: right;"><span class="fa fa-arrow-left">&nbsp;</span> Kembali</a>
    </div>
    <div class="panel-body">
        <div class="col-md-12">
            <form role="form" action="{{ route('transaksi-pengadaan.store') }}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="form-group">
                    <label>Tanggal Pengadaan</label>
                    <input type="date" class="form-control" id="tanggal_pengadaan" name="tanggal_pengadaan" required placeholder="Pilih tanggal pengadaan">
                </div>
                <div class="form-group">
                    <label>Tanggal Permintaan</label>
                    <input type="date" class="form-control" id="tanggal_permintaan" name="tanggal_permintaan" required placeholder="Pilih tanggal permintaan">
                </div>
                <div class="form-group">
                    <label>Barang</label>
                    <select class="form-control" id="barang" name="barang" required onchange="updateTotal()">
                        <option value="">Pilih Barang</option>
                            @foreach ($barang as $barang)
                                <option value="{{ $barang->id }}" data-harga="{{ $barang->harga_jual }}">{{ $barang->nama_barang }}</option>
                            @endforeach
                    </select>
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
                    <label>Total</label>
                    <input type="text" class="form-control" id="total" name="total" readonly>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="">Pilih Status</option>
                        <option value="Pending">Pending</option>
                        <option value="Approved">Approved</option>
                        <option value="Rejected">Rejected</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Bukti Acc</label>
                    <input type="file" class="form-control" id="bukti_acc" name="bukti_acc" accept="image/*">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                    <button class="btn btn-default" type="reset">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    function updateTotal() {
        var select = document.getElementById("barang");
        var harga = parseFloat(select.options[select.selectedIndex].getAttribute("data-harga")) || 0;
        var jumlah = parseInt(document.getElementById("jumlah_minta").value) || 0;
        var total = harga * jumlah;
        document.getElementById("total").value = "Rp " + number_format(total, 0, ',', '.');
    }

    // Function to format numbers
    function number_format(number, decimals, dec_point, thousands_sep) {
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? '.' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? ',' : dec_point,
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };

        var parts = toFixedFix(n, prec).split('.');
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, sep);
        return parts.join(dec);
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script>
    flatpickr("#tanggal_pengadaan", {
        dateFormat: "d-m-Y"
    });
    flatpickr("#tanggal_permintaan", {
        dateFormat: "d-m-Y"
    });
</script>
@endsection