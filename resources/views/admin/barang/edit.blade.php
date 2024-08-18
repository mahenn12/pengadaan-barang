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

@section('content')
<div class="panel panel-default col-md-12">
    <div class="panel-heading">Edit Data Barang
        <a href="{{ route('barang.index') }}" class="btn btn-default" style="float: right;"><span class="fa fa-arrow-left">&nbsp;</span> Kembali</a>
    </div>
    <div class="panel-body">
        <div class="col-md-12">
            <form role="form" action="{{ route('barang.update',$barang->id) }}" method="post">
            @csrf
            @method('put')
                <div class="form-group">
                    <label>Kode Barang</label>
                    <input value={{$barang->kode_barang}} class="form-control boxed" placeholder="Kode" required="required" name="kode_barang" type="text" id="kode" readonly>
                </div>
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input value={{$barang->nama_barang}} type="text" name="nama_barang" class="form-control" placeholder="Nama Barang">
                </div>
                <div class="form-group">
                    <label>Jenis Barang</label>
                    <select name="jenis_id" class="form-control">

                            @foreach($jenis as $data)
                                <option value="{{$data->id}}">{{$data->nama_jenis}}</option>
                            @endforeach

                    </select>
                </div>
                <div class="form-group">
                    <label>Satuan Barang</label>
                    <select name="satuan_id" class="form-control">

                            @foreach($satuan as $data)
                                <option value="{{$data->id}}">{{$data->nama_satuan}}</option>
                            @endforeach

                    </select>
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
