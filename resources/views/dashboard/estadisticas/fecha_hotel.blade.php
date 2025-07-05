@extends('sources-dashboard')

@section('head-title')

<title>VIAJETUR | ESTADISTICAS HOTELES</title>

@endsection

@section('content')

<!--TITLE BODY-->
<div class="wrapper">
	<div class="content-wrapper">
		<div class="container">
			<div class="content-header mb-4">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h4 class="m-0"><i class="fas fa-hotel"></i> ESTADISTICAS DE LOS HOTELES</h4>
						</div>
						<div class="col-sm-6">
							<div class="float-sm-right">
								<a href="{{route('estadisticas_hotel')}}" class="btn btn-dark">REGRESAR</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="container">

				<div class="text-center">
					<h4>Estadisticas desde {{$fecha1Formateada}} hasta el {{$fecha2Formateada}}</h4>
				</div>

				<!--GRAFICAS-->
				<div id="grafica1Div" class="mt-5">
					<div class="row">
						<div class="col-md-5 text-center">
							<h5>HOTELES MÁS VISITADOS</h5>
							@if($hotelesMasVistos->sum('vistas') == 0)
							<p class="text-muted mt-5">No hay grafica para mostrar</p>
							@else
							<canvas id="grafica2"></canvas>
							@endif
						</div>
						<div class="col-md-5 text-center">
							<h5>HOTELES MÁS RESERVADOS</h5>
							@if($hotelesMasReservados->sum('reservas') == 0)
							<p class="text-muted mt-5">No hay grafica para mostrar</p>
							@else
							<canvas id="grafica3"></canvas>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="{{ asset('static/js/chart.js') }}"></script>

<!--GRAFICA SCRIPT-->
<script>

	var ctx2 = document.getElementById('grafica2').getContext('2d');
	var nombresPaquetes = {!! json_encode($hotelesMasVistos->pluck('nombre')) !!};
	var vistasPaquetes = {!! json_encode($hotelesMasVistos->pluck('vistas')) !!};

	var myDoughnutChart = new Chart(ctx2, {
		type: 'doughnut',
		data: {
			labels: nombresPaquetes,
			datasets: [{
				label: 'Vistas',
				data: vistasPaquetes,
				backgroundColor: [
					'rgba(255, 99, 132, 0.8)',
					'rgba(54, 162, 235, 0.8)',
					'rgba(255, 206, 86, 0.8)',
					'rgba(75, 192, 192, 0.8)',
					'rgba(153, 102, 255, 0.8)',
					'rgba(255, 159, 64, 0.8)',
					'rgba(255, 204, 0, 0.8)'
					],
				borderColor: [
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
					'rgba(255, 159, 64, 1)',
					'rgba(255, 204, 0, 1)'
					],
				borderWidth: 1
			}]
		}
	});

	var ctx3 = document.getElementById('grafica3').getContext('2d');
	var nombreshotel = {!! json_encode($hotelesMasReservados->pluck('nombre')) !!};
	var vistaHoteles = {!! json_encode($hotelesMasReservados->pluck('reservas')) !!};

	var myDoughnutChart = new Chart(ctx3, {
		type: 'doughnut',
		data: {
			labels: nombreshotel,
			datasets: [{
				label: 'Reservas',
				data: vistaHoteles,
				backgroundColor: [
					'rgba(255, 99, 132, 0.8)',
					'rgba(54, 162, 235, 0.8)',
					'rgba(255, 206, 86, 0.8)',
					'rgba(75, 192, 192, 0.8)',
					'rgba(153, 102, 255, 0.8)',
					'rgba(255, 159, 64, 0.8)',
					'rgba(255, 204, 0, 0.8)'
					],
				borderColor: [
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
					'rgba(255, 159, 64, 1)',
					'rgba(255, 204, 0, 1)'
					],
				borderWidth: 1
			}]
		}
	});
</script>

@endsection
