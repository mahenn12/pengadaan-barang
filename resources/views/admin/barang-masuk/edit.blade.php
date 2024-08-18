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
				<h1 class="page-header">Barang Masuk</h1>
			</div>
		</div><!--/.row-->
@endsection

@section('content')

<div class="panel panel-default col-md-12">
    <div class="panel-heading"> Edit Barang Masuk
        <a href="{{ route('barang-masuk.index') }}" class="btn btn-default" style="float: right;"><span class="fa fa-arrow-left">&nbsp;</span> Kembali</a>
    </div>
    <div class="panel-body">
        <div class="col-md-12">
            <form role="form" action="{{ route('barang-masuk.update',$masuk->id) }}" method="post">
            @csrf
            @method('put')
                <div class="form-group">
                    <label>Kode Barang Masuk</label>
                    <input value={{$masuk->kode_barang_masuk}} class="form-control boxed" placeholder="Kode" required="required" name="kode_barang_masuk" type="text" id="kode" readonly>                    
                </div>
                <div class="form-group">
                    <label>Tanggal Masuk</label>
                    <input value={{$masuk->tanggal_masuk}} type="date" name=tanggal_masuk class="form-control">
                </div>
                <div class="form-group">
                    <label>Supplier</label>
                    <select name="supplier_id" class="form-control">
                            @foreach($supplier as $data)
                                <option value="{{$data->id}}">{{$data->nama_supplier}}</option>
                            @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Barang</label>
                    <select name="barang_id" class="form-control">
                        
                            @foreach($barang as $data)
                                <option value="{{$data->id}}">{{$data->nama_barang}}</option>
                            @endforeach
                        
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Qty</label>
                    <input value="{{$masuk->qty}}" type="number" name="qty" class="form-control" placeholder="Jumlah Masuk">
                </div>
                
                <div class="form-group">
                    <label>Penerima</label>
                    <select name="user_id" class="form-control">
                            @foreach($user as $data)
                                <option value="{{$data->id}}">{{$data->name}}</option>
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
