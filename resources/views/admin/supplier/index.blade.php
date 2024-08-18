@extends('layouts.app')

@section('header')
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Supplier</li>
			</ol>
		</div><!--/.row-->


		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Supplier</h1>
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
        $('#supplier').DataTable();
    });
    </script>
@endsection

@section('content')
    <div class="panel panel-default col-md-12">
        <div class="panel-heading">Supplier
            <a href="{{ route('supplier.create') }}" class="btn btn-primary" style="float: right;">
                <span class="fa fa-plus">&nbsp;</span> tambah</a>
        </div>
        <div class="panel-body">
            <table id="supplier" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">No Telepon</th>
                        <th class="text-center">Alamat</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @php $no=1 @endphp
                    @foreach ($supplier as $data)
                        <tr>
                            <td class="text-center">{{$no++}}</td>
                            <td class="text-center">{{$data->nama_supplier}}</td>
                            <td class="text-center">{{$data->no_telepon}}</td>
                            <td class="text-center">{{$data->alamat}}</td>
                            <td>
                                <form class="text-center" action="{{route('supplier.destroy',$data->id)}}" method="post">
                                @method('delete')
                                @csrf
                                    <a href="{{route('supplier.edit',$data->id)}}" class="btn btn-warning fa fa-edit"></a>
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
