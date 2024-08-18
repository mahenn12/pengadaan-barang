@extends('layouts.app')

@section('header')
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
					</a></li>
				<li class="active">Barang</li>
			</ol>
		</div><!--/.row-->


		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Barang</h1>
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
        $('#barang').DataTable();
    });
    </script>
@endsection

@section('content')
    <div class="panel panel-default col-md-12">
        <div class="panel-heading"> Barang
            <a href="{{ route('barang.create') }}" class="btn btn-primary" style="float: right;"><span class="fa fa-plus">&nbsp;</span> tambah</a>
        </div>
        <div class="panel-body">
            <table id="barang" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Kode Barang</th>
                        <th class="text-center">Nama Barang</th>
                        <th class="text-center">Jenis Barang</th>
                        <th class="text-center">Satuan</th>
                        <th class="text-center">Harga Beli</th>
                        <th class="text-center">Harga Jual</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- data -->
                     @php $no=1 @endphp
                    <!-- data -->
                    @foreach ($barang as $data)
                    <tr>
                        <td class="text-center">{{$no++}}</td>
                        <td class="text-center">{{$data->kode_barang}}</td>
                        <td class="text-center">{{$data->nama_barang}}</td>
                        <td class="text-center">{{$data->jenis->nama_jenis}}</td>
                        <td class="text-center">{{$data->satuan->nama_satuan}}</td>
                        <td class="text-center">{{ number_format($data->harga_beli, 0, ',', '.') }}</td>
                        <td class="text-center">{{ number_format($data->harga_jual, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <form class="text-center" action="{{route('barang.destroy',$data->id)}}" method="post">
                                @method('delete')
                                @csrf
                                <a href="{{route('barang.edit',$data->id)}}" class="btn btn-warning fa fa-edit"></a>
                                    <button type="submit" class="btn btn-danger fa fa-trash" onclick="return confirm('Apakah anda yakin menghapus')"></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection