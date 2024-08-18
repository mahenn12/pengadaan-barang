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

@section('content')
<div class="panel panel-default col-md-12">
    <div class="panel-heading"> Form Edit Supplier
        <a href="{{ route('supplier.index') }}" class="btn btn-default" style="float: right;"><span class="fa fa-arrow-left">&nbsp;</span> Kembali</a>
    </div>
    <div class="panel-body">
        <div class="col-md-12">
            <form role="form" action="{{ route('supplier.update',$supplier->id) }}" method="post">
                @csrf
                @method('put')
                <div class="form-group">
                    <label>Nama Supplier</label>
                    <input value="{{ $supplier->nama_supplier }}" type="text" name="nama_supplier" class="form-control" placeholder="Nama Supplier">
                </div>
                <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input value="{{ $supplier->no_telepon }}" type="text" name="no_telepon" class="form-control" placeholder="No Telepon">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" rows="5" placeholder="Alamat">{{ $supplier->alamat }}</textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                    <button class="btn btn-default" type="reset">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>

@endsection
