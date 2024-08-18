@extends('layouts.app')

@section('header')
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Satuan</li>
			</ol>
		</div><!--/.row-->


		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Satuan</h1>
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
        $('#satuan').DataTable();
    });
    </script>
@endsection

@section('content')
    <div class="panel panel-default col-md-12">
        <div class="panel-heading"> Satuan Barang
            <a href="{{ route('satuan.create') }}" class="btn btn-primary" style="float: right;"><span class="fa fa-plus">&nbsp;</span> Tambah</a>
        </div>
        <div class="panel-body">
            <table id="satuan" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Satuan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @php $no=1 @endphp
                    <!-- data -->
                    @foreach ($satuan as $data)
                    <tr>
                        <td class="text-center">{{$no++}}</td>
                        <td class="text-center">{{$data->nama_satuan}}</td>
                        <td class="text-center">
                            <form class="text-center" action="{{route('satuan.destroy',$data->id)}}" method="post">
                                @method('delete')
                                @csrf
                                    <a href="{{route('satuan.edit',$data->id)}}" class="btn btn-warning"><span class="fa fa-edit"></a>
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin menghapus')"><span class="fa fa-trash"></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
