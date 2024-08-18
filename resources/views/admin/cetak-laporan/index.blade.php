@extends('layouts.app')

@section('header')
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Cetak Laporan</li>
			</ol>
		</div><!--/.row-->


		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Cetak Laporan</h1>
			</div>
		</div><!--/.row-->
@endsection

@section('content')
    <div class="panel panel-default col-md-12">
        <div class="panel-heading">Cetak Laporan
        </div>
        <div class="panel-body"><br>
            <form action="/pengadaanbarang/cetak-laporan" method="post">
                @csrf
            <div class="form-check">
                <input class="form-check-input" type="radio" name="cetak" id="cetak1" value="masuk" checked>
                <label class="form-check-label" for="cetak1">
                  <h4> Barang Masuk</h4>
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="cetak" id="cetak2" value="keluar">
                <label class="form-check-label" for="cetak2">
                  <h4> Barang Keluar</h4>
                </label>
              </div><br>
              <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Tanggal Awal</label>
                                <input type="date" name=tanggal_awal class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Tanggal Akhir</label>
                                <input type="date" name=tanggal_akhir class="form-control">
                            </div>
                        </div>
                    </div>
            <button name="submit" type="submit" class="btn btn-primary btn-block btn-lg">
                <em class="fa fa-print">&nbsp;</em> Cetak</button></form>
        </div><br>

    </div>
@endsection
