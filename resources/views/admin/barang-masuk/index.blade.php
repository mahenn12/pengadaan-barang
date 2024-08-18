@extends('layouts.app')

@section('header')
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Barang Masuk</li>
			</ol>
		</div><!--/.row-->


		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Barang Masuk</h1>
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
        $('#barang-masuk').DataTable();
    });
    </script>
@endsection

@section('content')
    <div class="panel panel-default col-md-12">
        <div class="panel-heading"> Barang Masuk
            <a href="{{ route('barang-masuk.create') }}" class="btn btn-primary" style="float: right;"><span class="fa fa-plus">&nbsp;</span> tambah</a>
        </div>
        <div class="panel-body">
            <table id="barang-masuk" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Kode Barang Masuk</th>
                        <th class="text-center">Tanggal Masuk</th>
                        <th class="text-center">Supplier</th>
                        <th class="text-center">Nama Barang</th>
                        <th class="text-center">Qty</th>
                        <th class="text-center">Penerima</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- data palsu -->
                     @php $no=1 @endphp
                    <!-- data -->
                    @foreach ($masuk as $data)
                    <tr>
                        <td class="text-center">{{$no++}}</td>
                        <td class="text-center">{{$data->kode_barang_masuk}}</td>
                        <td class="text-center">{{$data->tanggal_masuk}}</td>
                        <td class="text-center">{{$data->supplier->nama_supplier}}</td>
                        <td class="text-center">{{$data->barang->nama_barang}}</td>
                        <td class="text-center">{{$data->qty}}</td>
                        <td class="text-center">{{$data->user->name}}</td>
                        <td class="text-center">
                            <form class="text-center" action="{{route('barang-masuk.destroy',$data->id)}}" method="post">
                                @method('delete')
                                @csrf
                                <a href="{{route('barang-masuk.edit',$data->id)}}" class="btn btn-warning fa fa-edit"></a>
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
