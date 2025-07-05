@extends('sources-dashboard')

@section('head-title')

<title>VIAJETUR | HOTELES</title>

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
							<h4 class="m-0"><i class="fas fa-hotel"></i> HOTELES DISPONIBLES</h4>
						</div>
						<div class="col-sm-6">
							<div class="float-sm-right">

								<div class="float-sm-right ml-2">
									<a href="{{url('/hotel')}}" class="btn btn-primary"><i class="fas fa-table"> </i></a>
								</div>

								<a href="{{url('hotel/create')}}" class="btn btn-success">AGREGAR</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!--SEARCH
			<div class="container mb-4">
				<div class="container mb-2">
					<div class="row">
						<div class="col">
							<input type="text" class="form-control" placeholder="Nombre Del Hotel...">
						</div>

						<div class="col">
							<input type="text" class="form-control" placeholder="Descripción...">
						</div>
						<div class="col input-group">
							<select name="tipo" class="custom-select">
								<option value="">Estado</option>
							</select>
						</div>
						<div class="col">
							<input type="text" class="form-control" placeholder="Correo...">
						</div>
					</div>
				</div>

				<div class="container">
					<div class="row">
						<div class="col">
							<input type="text" class="form-control" placeholder="Teléfono...">
						</div>
						<div class="col">
							<input type="text" class="form-control" placeholder="Whatsapp...">
						</div>
						<div class="col input-group">
							<select name="tipo" class="custom-select">
								<option value="">Ubicación</option>
							</select>
						</div>
					</div>
				</div>
			</div>
		-->

		<!--CARD-->
		<div class="container-fluid">
			<div class="container">
				<div class="row">
					@foreach ($hoteles as $hotel)			
					<div class="col-lg-6 mb-4">
						<div class="card">
							<div class="card-header text-center p-0">
								<img src="{{asset('storage'.'/'.$hotel->foto)}}"  style="height:400px;" class="card-img-top" alt="...">
								<div class="container-fluid d-flex justify-content-center my-3">
									<h5 class="card-title mb-1"><strong> {{ strtoupper($hotel->nombre) }}</strong></h5>

								</div>
							</div>
							<div class="card-body m-0 py-0">

								<div class="row mb-0 container-fluid my-3">
									<div class="col-md-12 text-center">
										<p class="card-text text-truncate mx-1 text-muted"><strong>Clase: </strong>@for ($i = 0; $i < $hotel->categoria; $i++)<i class="fas fa-star text-warning"></i>@endfor</p>
									</div>
								</div>
								<div class=" mb-0 container-fluid row">
									<div class="col-md-6">
										<p class="card-text text-truncate mx-1 text-muted"><i class="fa fa-phone text-info"></i><strong>: </strong>{{isset($hotel->telefono)?$hotel->telefono:'No posee'}}</small></p>
									</div>
									<div class="col-md-6">
										<p class="card-text text-truncate mx-1 text-muted"><i class="fab fa-whatsapp text-success"></i><strong>: </strong>{{isset($hotel->whatsapp)?$hotel->whatsapp:'No posee'}}</p>												
									</div>
								</div>

								<p class="my-3 mb-0"><small class="text-muted"><strong class="text-md">Descripción: </strong></small> <span class="text-sm">{{$hotel->descripcion}}</span></p>

								<div class="row mb-0 container-fluid ">
									<div class="col-md-6">
										<p class="card-text mx-1 text-muted"><strong>Ubicación: </strong>{{$hotel->destino->nombre}}</p>
									</div>
									<div class="col-md-6">
										<p class="card-text mx-1 text-muted"><strong>Estado: </strong>@if($hotel->estado == 1)
											<span class="text-success">Activo</span>
											@else
											<span class="text-danger">Inactivo</span>
										@endif</p>
									</div>
								</div>


								<div class="text-center my-2">
									<p class="text-truncate mx-1 text-muted"><strong>Vistas (</strong>{{$hotel->vistas}} vistas)</p>
								</div>
							</div>
							<div class="py-4 m-0">	
								<div class="conteiner-fluid d-flex justify-content-center row m-0">				
									<form class="conteiner-fluid row m-0"  action="{{url('hotel/'.$hotel->id.'/')}}" method="post">
										<a href="{{url('/hotel/'.$hotel->id)}}" class="btn btn-primary">SELECCIONAR</a>
										<a href="{{url('/hotel/'.$hotel->id.'/edit')}}" class="btn btn-success mx-2"><i class="fas fa-pen-alt"></i></a>
										@csrf
										{{method_field('DELETE')}}
										<button type="submit"  class="btn btn-danger" onclick="return confirm('¿Quieres borrar {{$hotel->nombre}} de la lista de hoteles?')" value="{{$hotel->id}}"><i class="fas fa-trash-alt"></i></button>
									</form>
								</div>
							</div>
						</div>
					</div>
					@endforeach
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