@extends('sources-dashboard')

@section('head-title')

<title>VIAJETUR | ESTADISTICAS DESTINOS</title>

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
							<h4 class="m-0"><i class="fas fa-chart-bar"></i> ESTADISTICAS DE LOS DESTINOS</h4>
						</div>
					</div>
				</div>
			</div>


			<!--SEARCH-->
			<div class="container mb-1">

				<div class="row">
					<form action="{{ route('estadisticas_destinos_generado') }}" method="POST" class="col-md-8">
						<div class="row">
							<div class="col-md-3">
								<label>Fecha inicial</label>
								<input type="date" name="fecha1" class="form-control">
							</div>
							<div class="col-md-3 mx-1">
								<label>Fecha final</label>
								<input type="date" name="fecha2" class="form-control">
							</div>
							<div class="col-md-3">
								<label>Generar estadistica</label>
								<input type="submit" class="btn btn-success" value="Generar">
							</div>
						</div>
						@csrf
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

@endsection
