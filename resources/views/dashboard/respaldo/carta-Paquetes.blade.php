@extends('sources-dashboard')

@section('head-title')

<title>VIAJETUR | PAQUETES</title>

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
							<h4 class="m-0"><i class="fas fa-hiking"></i> PAQUETES DISPONIBLES</h4>
						</div>
						<div class="col-sm-6">
							<div class="float-sm-right">
								<a href="{{url('paquete/create')}}" class="btn btn-success">AGREGAR</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!--SEARCH
			<div class="container mb-4">
				<div class="container">

					<div class="col">
						<input type="text" class="form-control" placeholder="Tipo De Paquete...">
					</div>
				</div>
			</div>
		-->

		<div class="container-fluid">
			<div class="container">
				<div class="row">
					@forelse ($paquetes as $paquete)
					<div class="col-md-6 mb-4">
						<div class="card">
							<img src="{{asset('storage'.'/'.$paquete->foto)}}" style="height:300px;" class="card-img-top" alt="...">
							<div class="card-header">
								<div class="container-fluid d-flex justify-content-center">
									<h5 class="card-title mb-1"><strong> {{ strtoupper($paquete->nombre) }}</strong></h5>
								</div>
							</div>
							<div class="row mb-1 container-fluid m-1" >
								<div class="col-md-6">
									<p class="card-text text-truncate mx-1"><small class="text-muted"><strong><i class="fas fa-clock"></i> Días: </strong>{{$paquete->dias}}</small></p>
								</div>
								<div class=" col-md-6">
									<p class="card-text text-truncate mx-1"><small class="text-muted"><strong><i class="fas fa-users"></i> Personas: </strong>{{$paquete->capacidad}}</small></p>
								</div>
								<div class=" col-md-6">
									<p class="card-text text-truncate mx-1"><small class="text-muted"><strong><i class="fas fa-map"></i> Destino: </strong>{{$paquete->destino->nombre}}</small></p>
								</div>
								<div class=" col-md-6">
									<p class="card-text text-truncate mx-1"><small class="text-muted"><strong><i class="fas fa-dollar-sign"></i> Precio: </strong>{{$paquete->precio}}$</small></p>
								</div>
							</div>
							<div class="row mb-0 container-fluid ">

							</div>
							<div class="container-fluid mt-2">
								<p class="card-text m-0"><small class="text-muted"><strong class="text-md">Descripción: </strong></small><span class="text-sm">{{$paquete->descripcion}}</span></p>

							</div>
							<br>
							<br>
							<div class="row mt-2 mb-1 container-fluid ">
								<div class=" col-md-6">
									<p class="card-text text-truncate mx-1 text-muted"><small><strong>Hotel: </strong>{{isset($paquete->hotel->nombre)?$paquete->hotel->nombre:'no posee'}}</small></p>
								</div>
								<div class=" col-md-6">
									<p class="card-text text-truncate mx-1 text-muted"><small><strong>Estado: </strong>@if($paquete->estado == 1)
										<span class="text-success">Disponible</span>
										@else
										<span class="text-danger">Agotado</span>
										@endif
									</small></p>
								</div>
							</div>
							<div class="row mt-0 mb-1 container-fluid">
								<div class="col-md-6">
									<p class="card-text text-truncate mx-1 text-muted"><small><strong>Vistas:( </strong>{{$paquete->vistas}} Vistas<strong>)</strong></small></p>	
								</div>
								<div class="col-md-6">
									<p class="card-text text-truncate mx-1 text-muted"><small><strong>Reservas:( </strong>{{$paquete->reservas}} Reservas<strong>)</strong></small></p>	
								</div>
							</div>

							<div class="py-4 m-0">				
								<form class="conteiner-fluid d-flex justify-content-center row m-0"  action="{{url('paquete/'.$paquete->id.'/')}}" method="POST">
									<a href="{{ route('dashboard-package-show',[Str::slug($paquete->nombre),$paquete->id]) }}" class="btn btn-primary"><i class="fas fa-eye"></i> Ver Paquete</a>
									<a href="{{url('/paquete/'.$paquete->id.'/edit')}}" class="btn btn-success mx-2"><i class="fas fa-pen-alt"></i></a>
									@csrf
									{{method_field('DELETE')}}
									<button type="submit"  class="btn btn-danger" onclick="return confirm('¿Quieres borrar {{$paquete->nombre}} de la lista de paquetees?')" value="{{$paquete->id}}"><i class="fas fa-trash-alt"></i></button>
								</form>
							</div>
						</div>
					</div>
					@empty
					<div class="container my-5">
						<h3 class="text-center">No existen paquetes registrados</h3>
					</div>
					@endforelse
				</div>
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