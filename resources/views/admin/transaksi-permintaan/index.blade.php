@extends('layouts.app')

@section('header')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                <em class="fa fa-home"></em>
            </a></li>
            <li class="active">Transaksi Permintaan</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Halaman Permintaan</h1>
        </div>
    </div><!--/.row-->
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script>
    $(document).ready(function() {
        $('.table').DataTable();
    });
    </script>
@endsection

@section('content')
<div class="panel panel-default col-md-12">
    <div class="panel-heading">Daftar Transaksi Permintaan
        <a href="{{ route('transaksi-permintaan.create') }}" class="btn btn-primary" style="float: right;">Tambah Baru</a>
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th style="text-align: center;">No</th>
                    <th style="text-align: center;">Tanggal Permintaan</th>
                    <th style="text-align: center;">Barang</th>
                    <th style="text-align: center;">Pelanggan</th>
                    <th style="text-align: center;">Jumlah Minta</th>
                    <th style="text-align: center;">Total</th>
                    <th style="text-align: center;">Keterangan</th>
                    <th style="text-align: center;">Status</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permintaan as $transaksi)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $transaksi->tanggal_permintaan }}</td>
                    <td>{{ $transaksi->barang->nama }}</td>
                    <td>{{ $transaksi->pelanggan->nama }}</td>
                    <td>{{ $transaksi->jumlah_minta }}</td>
                    <td>{{ number_format($transaksi->total, 2) }}</td>
                    <td>{{ $transaksi->keterangan }}</td>
                    <td>{{ $transaksi->status_permintaan }}</td>
                    <td>
                        <a href="{{ route('transaksi-permintaan.edit', $transaksi->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('transaksi-permintaan.destroy', $transaksi->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection