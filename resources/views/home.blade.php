@extends('layouts.app')


@section('header')
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Dashboard</li>
			</ol>
		</div><!--/.row-->


		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Dashboard</h1>
			</div>
		</div><!--/.row-->
        @endsection

@section('content')
		<div class="panel panel-container">

<div class="row">
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-teal panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-users color-blue"></em>
							<div class="large">{{ DB::table('suppliers')->count(); }}</div>
							<div class="text-muted">Data Supplier</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-blue panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-dropbox color-orange"></em>
							<div class="large">{{ DB::table('barangs')->count(); }}</div>
							<div class="text-muted">Total Data Barang</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-orange panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-download color-teal"></em>
							<div class="large">{{ DB::table('barang_masuks')->count(); }}</div>
							<div class="text-muted">Total Data Barang Masuk</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-red panel-widget ">
						<div class="row no-padding"><em class="fa fa-xl fa-upload color-red"></em>
							<div class="large">{{ DB::table('barang_keluars')->count(); }}</div>
							<div class="text-muted">Total Data Barang Keluar</div>
						</div>
					</div>
				</div>
			</div></div>

<!--/.row-->
<br>
@endsection

@section('c')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @role('admin')
                        Role Admin {{ \Laratrust::hasRole('admin') }}
                    @endrole

                    @role('petugas')
                        Role Petugas {{ \Laratrust::hasRole('petugas') }}
                    @endrole

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
