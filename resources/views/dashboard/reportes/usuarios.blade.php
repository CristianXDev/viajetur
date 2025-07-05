@extends('sources-dashboard')

@section('head-title')

<title>VIAJETUR | REPORTE DE USUARIOS</title>

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
							<h4 class="m-0"><i class="fas fa-users"></i> REPORTE DE USUARIOS</h4>
						</div>
					</div>
				</div>
			</div>

		<!--SEARCH
		<div class="container mb-4">
			<div class="container">
				<div class="row mb-2">
					<div class="col">
						<input type="text" class="form-control" placeholder="Tipo De Paquete...">
					</div>
					<div class="col">
						<input type="color" class="form-control" placeholder="Color...">
					</div>
				</div>
			</div>
		</div>
	-->

	<!--CARD-->
	<div class="container mt-5">
		<div class="col-md-8 mx-auto">
			<form action="{{ route('reporte_usuario_pdf') }}" method="POST" class="card card-primary">
				<img class="card-img-top" src="{{ asset('static/images/destinos.jpg') }}" alt="Imagen Principal" style="height:200px;">

				<div class="container">
					<div class="mx-auto" style="width:100px; height:100px;">
						<div class=" rounded-circle bg-purple text-white text-center py-3" style="margin-top:-50px;">
							<h1><i class="fas fa-users"></i></h1>
						</div>
					</div>

					<div class="text-center">
						<h4>- REPORTES DE USUARIOS -</h4>
					</div>

				</div>

				<div class="card-body">

					<label for="">Rol</label>

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text bg-purple" style="height: 38px; border:1px solid purple;"><i class="fa fa-user-tag"></i></span>
						</div>
						<select name="rol" class="form-control">
							<option value="5">Todos</option>
							<option value="3">Cliente</option>
							<option value="1">Administrador</option>
							<option value="2">Asistente</option>
							<option value="4">Provedor</option>
						</select>
					</div>

					<hr>
<!--
					<label for="">Estado</label>

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text bg-purple" style="height: 38px; border:1px solid purple;"><i class="fa fa-map-marker-alt"></i></span>
						</div>
						<select name="estado" class="form-control">
							<option value="5">Todos</option>
							@foreach ($estados as $estado)
							<option value="{{$estado->id}}">{{$estado->nombre}}</option>
							@endforeach
						</select>
					</div>
-->
					<label for="">Municipio</label>

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text bg-purple" style="height: 38px; border:1px solid purple;"><i class="fa fa-map-marker-alt"></i></span>
						</div>
						<select name="municipio" class="form-control">
							<!--<option value="0">Todos</option>-->
							@foreach ($municipios as $municipio)
							<option value="{{$municipio->id}}">{{$municipio->nombre}}</option>
							@endforeach
						</select>
					</div>

					<hr>

					<div class="row">
						<div class="col-md-6">
							<label for="">Fecha de inicio</label>

							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text bg-purple" style="height: 38px; border:1px solid purple;"><i class="fa fa-map-marker-alt"></i></span>
								</div>
								<input type="date" name="fechaIni" class="form-control">
							</div>
						</div>

						<div class="col-md-6">
							<label for="">Fecha de fin</label>

							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text bg-purple" style="height: 38px; border:1px solid purple;"><i class="fa fa-map-marker-alt"></i></span>
								</div>
								<input type="date" name="fechaFin" class="form-control">
							</div>
						</div>
					</div>

					<hr>

					<div class="float-sm-right">
						<a href="{{ route('dashboard') }}" class="btn btn-dark">REGRESAR</a>
						<input type="submit" class="btn btn-success" value="GENERAR REPORTE">
					</div>
				</div>
				@csrf
			</form>
		</div>  
	</div>


			<!--PAGINATE
			<div class="container-fluid pb-4">
				<nav aria-label="Page navigation example">
					<ul class="pagination justify-content-center">
						<li class="page-item"><a class="page-link" href="#">Anterior</a></li>
						<li class="page-item active"><a class="page-link" href="#">1</a></li>
						<li class="page-item"><a class="page-link" href="#">2</a></li>
						<li class="page-item"><a class="page-link" href="#">3</a></li>
						<li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
					</ul>
				</nav>
			</div>
		-->
		@endsection