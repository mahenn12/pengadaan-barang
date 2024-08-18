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
            <h1 class="page-header">Transaksi Pengadaan</h1>
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
        $('#transaksi-pengadaan').DataTable();
    });
    </script>
@endsection

@section('content')
    <div class="panel panel-default col-md-12">
        <div class="panel-heading"> Transaksi Pengadaan
            <a href="{{ route('transaksi-pengadaan.create') }}" class="btn btn-primary" style="float: right;"><span class="fa fa-plus">&nbsp;</span> tambah</a>
        </div>
        <div class="panel-body">
            <table id="transaksi-pengadaan" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Tanggal Pengadaan</th>
                        <th class="text-center">Tanggal Permintaan</th>
                        <th class="text-center">Barang</th>
                        <th class="text-center">Pelanggan</th>
                        <th class="text-center">Jumlah Minta</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Keterangan</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Bukti Acc</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no=1 @endphp
                    @foreach ($pengadaan as $data)
                    <tr>
                        <td class="text-center">{{$no++}}</td>
                        <td class="text-center">{{$data->tanggal_pengadaan}}</td>
                        <td class="text-center">{{$data->tanggal_permintaan}}</td>
                        <td class="text-center">{{$data->barang->nama}}</td>
                        <td class="text-center">{{$data->pelanggan->nama}}</td>
                        <td class="text-center">{{$data->jumlah_minta}}</td>
                        <td class="text-center">{{ number_format($data->total, 2) }}</td>
                        <td class="text-center">{{$data->keterangan}}</td>
                        <td class="text-center">{{$data->status}}</td>
                        <td class="text-center"><img src="{{ Storage::url($data->bukti_acc) }}" height="50" width="50"></td>
                        <td class="text-center">
                            <form class="text-center" action="{{route('transaksi-pengadaan.destroy', $data->id)}}" method="post">
                                @method('delete')
                                @csrf
                                <a href="{{route('transaksi-pengadaan.edit', $data->id)}}" class="btn btn-warning fa fa-edit"></a>
                                <button type="submit" class="btn btn-danger fa fa-trash" onclick="return confirm('Apakah anda yakin menghapus?')"></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection