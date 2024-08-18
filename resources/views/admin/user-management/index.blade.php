@extends('layouts.app')

@section('header')
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">User Management</li>
			</ol>
		</div><!--/.row-->


		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">User Management</h1>
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
        $('#user').DataTable();
    });
    </script>
@endsection

@section('content')
    <div class="panel panel-default col-md-12">
        <div class="panel-heading"> User Manangement
            <a href="{{ route('user-management.create') }}" class="btn btn-primary" style="float: right;"><span class="fa fa-plus">&nbsp;</span> tambah</a>
        </div>
        <div class="panel-body">
            <table id="user" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Role</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no=1 @endphp
                    <!-- data -->
                    @foreach ($user as $data)
                    @if ($loop->first)
                        <tr>
                        <td class="text-center">{{$no++}}</td>
                        <td class="">{{$data->name}}</td>
                        <td class="">{{$data->email}}</td>

                        @foreach ($data->roles as $role)
                            <td>{{$role->name}}</td>
                        @endforeach
                        <td class="text-center">
                            <a href="{{ route('user-management.edit', $data->id) }}" class="btn btn-warning"><span class="fa fa-edit"></span></a>
                        </td>
                    </tr>
                    @else
                    <tr>
                        <td class="text-center">{{$no++}}</td>
                        <td class="">{{$data->name}}</td>
                        <td class="">{{$data->email}}</td>

                        @foreach ($data->roles as $role)
                            <td>{{$role->name}}</td>
                        @endforeach
                        <td>
                            <form class="text-center" action="{{route('user-management.destroy',$data->id)}}" method="post">
                                @method('delete')
                                @csrf
                                    <a href="{{route('user-management.edit',$data->id)}}" class="btn btn-warning"><span class="fa fa-edit"></span></a>
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin menghapus')"><span class="fa fa-trash"></span></button>
                            </form>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
