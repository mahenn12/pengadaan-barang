<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CV. 11 Cahaya Bintang</title>
    <link rel="icon" href="" type="image/png" sizes="16x16">
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/datepicker3.css') }}" rel="stylesheet">
	<link href="{{ asset('css/styles.css') }}" rel="stylesheet">

	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="{{ asset('js/html5shiv.js') }}"></script>
	<script src="{{ asset('js/respond.min.js') }}"></script>
	<![endif]-->
    @yield('css')
</head>
<body>

    <br><br>

    <div class="container text-center">
        <img src="img/Logo_CV-removebg-preview.png" width="200" alt="">
            <h1>CV. 11 Cahaya Bintang</h1>
            <br>
            <div class="row">
                <div class="col-sm-5"></div>
        <div class=""><a href="{{ route('login') }}" class="btn btn-primary col-sm-2">LOGIN</a></div>
        <div class="col-sm-5"></div>
    </div>
    </div>

    <br><br><br><br><br><br><br><br><br><br><br>

    @include('layouts.partials.footer')

    <script src="{{ asset('js/jquery-1.11.1.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/chart.min.js') }}"></script>
	<script src="{{ asset('js/chart-data.js') }}"></script>
	<script src="{{ asset('js/easypiechart.js') }}"></script>
	<script src="{{ asset('js/easypiechart-data.js') }}"></script>
	<script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('js/custom.js') }}"></script>
	<script>
		window.onload = function () {
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
};
	</script>

    @yield('js')

</body>
</html>
