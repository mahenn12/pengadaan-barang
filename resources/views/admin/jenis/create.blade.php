@extends('layouts.app')

@section('header')
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Jenis</li>
			</ol>
		</div><!--/.row-->


		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Jenis</h1>
			</div>
		</div><!--/.row-->
@endsection

@section('content')
<div class="panel panel-default col-md-12">
    <div class="panel-heading">Form Tambah Jenis
        <a href="{{ route('jenis.index') }}" class="btn btn-default" style="float: right;"><span class="fa fa-arrow-left">&nbsp;</span> Kembali</a>
    </div>
    <div class="panel-body">
        <div class="col-md-12">
            <form role="form" action="{{ route('jenis.store') }}" method="post">
            @csrf
                <div class="form-group">
                    <label>Nama Jenis</label>
                    <input type="text" name="nama_jenis" class="form-control" placeholder="Nama Jenis">
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
