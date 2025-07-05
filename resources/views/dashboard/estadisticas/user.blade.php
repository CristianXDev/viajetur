@extends('sources-dashboard')

@section('head-title')

<title>VIAJETUR | ESTADISTICAS USUARIOS</title>

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
							<h4 class="m-0"><i class="fas fa-chart-bar"></i> ESTADISTICAS DE USUARIOS</h4>
						</div>
					</div>
				</div>
			</div>

			<!--GRAFICAS-->
			<div class="container my-5"> 
				<div class="row">
					<div class="col-md-6 mb-5">
						<div class="text-center">
							<p>USUARIOS REGISTRADOS - POR ROL</p>
						</div>
						<canvas id="grafica"></canvas>
					</div>

					<!--GRAFICAS-->
					<div class="col-md-6 mb-5">
						<div class="text-center">
							<p>USUARIOS REGISTRADOS - POR ESTATUS</p>
						</div>
						<canvas id="grafica2"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="{{ asset('static/js/chart.js') }}"></script>

<!--GRAFICA SCRIPT-->
<script>
	var ctx = document.getElementById('grafica').getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'doughnut',
		data: {
			labels: ['Administradores', 'Asistentes', 'Clientes', 'Proveedores'],
			datasets: [{
				label: 'Cantidad',
				data: [
					{{ $administadores }},
					{{ $asistentes }},
					{{ $clientes }},
					{{ $proveedores }}
					],
				backgroundColor: [
					'rgba(255, 99, 132, 0.5)',
					'rgba(54, 162, 235, 0.5)',
					'rgba(255, 206, 86, 0.5)',
					'rgba(75, 192, 192, 0.5)'
					],
			}]
		}
	});

	var ctx2 = document.getElementById('grafica2').getContext('2d');
	var myChart2 = new Chart(ctx2, {
		type: 'doughnut',
		data: {
			labels: ['Activos', 'Inactivos', 'Suspendidos'],
			datasets: [{
				label: 'Cantidad de usuarios',
				data: [
					{{ $UserActivo }},
					{{ $UserInactivo }},
					{{ $UserSuspendido }}
					],
				backgroundColor: [
					'rgba(75, 192, 192, 0.5)',
					'rgba(255, 99, 132, 0.5)',
					'rgba(54, 162, 235, 0.5)'
					],
			}]
		}
	});
</script>

@endsection
