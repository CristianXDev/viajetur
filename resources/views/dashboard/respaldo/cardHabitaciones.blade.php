@extends('sources-dashboard')

@section('head-title')

<title>VIAJETUR | HABITACIONES</title>

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
							<h4 class="m-0"><i class="fas fa-bed"></i> HABITACIONES DISPONIBLES</h4>
						</div>
						<div class="col-sm-6">
							<div class="float-sm-right">

								<div class="float-sm-right ml-2">
									<a href="{{url('/habitacion')}}" class="btn btn-primary"><i class="fas fa-table"> </i></a>
								</div>

								<a href="{{url('habitacion/create')}}" class="btn btn-success">AGREGAR</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!--SEARCH
			<div class="container mb-4">
				<div class="container">
					<div class="row mb-2">
						<div class="col">
							<input type="text" class="form-control" placeholder="Numero De Habitación...">
						</div>
						<div class="col">
							<input type="number" class="form-control" placeholder="Capacidad...">
						</div>
						<div class="col">
							<input type="text" class="form-control" placeholder="Tipo...">
						</div>
					</div>

					<div class="row">
						<div class="col">
							<input type="text" class="form-control" placeholder="Comodidades...">
						</div>
						<div class="col">
							<input type="text" class="form-control" placeholder="Hotel...">
						</div>
					</div>
				</div>
			</div>
		</div>
	-->

	<!--CARD-->
	<div class="container-fluid">
		<div class="container">
			<div class="row">
				@foreach ($habitaciones as $habitacion)			
				<div class="col-sm-6 mb-4">
					<div class="card">
						<div class="card-header p-0 text-center">
							<img src="{{asset('storage'.'/'.$habitacion->foto)}}"  style="height:400px;" class="card-img-top" alt="...">
							<div class="container-fluid d-flex justify-content-center my-3">
								<h5 class="card-title mb-1"><strong> {{$habitacion->num_habitacion}}</strong></h5>
							</div>
						</div>
						<div class="card-body my-3 py-0">
							<div class="row container-fluid ">

								<div class="col-md-6">
									<div class="m-0 p-0">
										<p class="card-text mx-1 text-muted"><strong>Estado: </strong>@if($habitacion->ocupado == 1)
											<span class="text-success">Libre</span>
											@else
											<span class="text-danger">Ocupada</span>
										@endif</p>
									</div>
								</div>

								<div class="col-md-6">
									<div class="m-0 p-0">
										<p class="card-text mx-1 text-muted"><strong>Estado: </strong>@if($habitacion->estado == 1)
											<span class="text-success">Activo</span>
											@else
											<span class="text-danger">Inactivo</span>
										@endif</p>
									</div>
								</div>

							</div>

							<p class="mt-3 mb-0"><small class="text-muted"><strong class="text-md">Comodidades: </strong></small>{{$habitacion->comodidades}}</p>

							<div class="row mb-0 container-fluid mt-3">
								<p class="card-text mx-1 text-muted"><strong>Nombre del Hotel: </strong>{{$habitacion->hotel->nombre}}</p>
							</div>
						</div>
						<div class="d-flex justify-content-center">				
							<form class="conteiner-fluid row m-0 pt-2 pb-4"  action="{{url('habitacion/'.$habitacion->id.'/')}}" method="post">
								<a href="#" class="btn btn-primary">SELECCIONAR</a>
								<a href="{{url('/habitacion/'.$habitacion->id.'/edit')}}" class="btn btn-success mx-2"><i class="fas fa-pen-alt"></i></a>
								@csrf
								{{method_field('DELETE')}}
								<button type="submit"  class="btn btn-danger" onclick="return confirm('¿Quieres borrar {{$habitacion->num_habitacion}} de la lista de habitaciones?')" value="{{$habitacion->id}}"><i class="fas fa-trash-alt"></i></button>
							</form>
						</div>
					</div>
				</div>
				@endforeach
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