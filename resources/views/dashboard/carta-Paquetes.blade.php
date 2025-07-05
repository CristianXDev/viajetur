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
						@if (Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->agregar == 1)
						<div class="col-sm-6">
							<div class="float-sm-right">
								<a href="{{url('paquete/create')}}" class="btn btn-success">AGREGAR</a>
							</div>
						</div>
						@endif
					</div>
				</div>
			</div>

			<!--SEARCH-->
			<div class="container mb-1">
				<div class="row">
					<div class="col-md-8">
						<div class="input-group mb-3 align-items-center">
							<input type="text" id="searchInput" class="form-control" placeholder="Ingrese su búsqueda" aria-label="Búsqueda" aria-describedby="basic-addon2">
							<div class="input-group-append">
								<span class="input-group-text">
									<i class="fas fa-search py-1"></i> <!-- Icono de búsqueda de Font Awesome -->
								</span>
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="d-flex align-items-center justify-content-center">
							<label for="selectPaginado">Filas por página:</label>
							<select id="selectPaginado" class="form-control w-50 ml-1">
								<option value="100">100</option>
								<option value="50">50</option>
								<option value="20">20</option>
								<option value="10">10</option>
								<option value="5">5</option>
							</select>
						</div>
					</div>
				</div>
			</div>


			<div id="noResultMessage" class="text-center mt-5" style="display: none;">
				<h3>No se encontraron resultados.</h3>
			</div>

			<div class="container-fluid">
				<div class="container">
					<div class="row">
						@forelse ($paquetes as $paquete)
						<div class="col-md-6 mb-4">
							<div class="card">

								<div id="carouselExampleIndicators-{{ $paquete->id }}" class="carousel slide" data-ride="carousel">
									<ol class="carousel-indicators">
										<li data-target="#carouselExampleIndicators-{{ $paquete->id }}" data-slide-to="0" class="active"></li>
										@if (count($paquete->fotoPaquete) > 0)
										@php
										for ($i=0; $i < count($paquete->fotoPaquete); $i++) { 
											# code...
											echo '<li data-target="#carouselExampleIndicators-{{ $hotel->id }}" data-slide-to="1"></li>';
										}

										@endphp


										@endif
										<!-- Agregar más validaciones para las otras fotos -->
									</ol>
									<div class="carousel-inner">
										<div class="carousel-item active">
											<img src="{{ asset('storage'.'/'.$paquete->foto) }}" class="d-block w-100" height="400" alt="...">

										</div>
										@if (count($paquete->fotoPaquete) > 0)
										@foreach ($paquete->fotoPaquete as $foto)											
										<div class="carousel-item">
											<img src="{{ asset('storage'.'/'.$foto->foto) }}" class="d-block w-100" height="400" alt="...">
											@if (Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->editar == 1 && Auth()->user()->id == $paquete->user->id)
											<form class="m-0 p-0"  action="{{url('paquete/foto/'.$foto->id)}}" style="position: absolute; top:3%; left:75%;" method="post">									
												<!-- complemento pra el formulario para la ruta borrar imagenes del hotel-->
												@csrf
												<input type="hidden" name="id_user" value="{{$paquete->user->id}}">
												<input type="hidden" name="id_paquete" value="{{$paquete->id}}">

												{{ method_field('PATCH') }}
												<button type="submit"  class="btn btn-danger" onclick="return confirm('¿Quieres borrar la imagen de la galeria del Paquete {{$paquete->nombre}}?')" ><i class="fas fa-trash-alt"></i></button>
											</form>
											@endif
										</div>
										@endforeach
										@endif


										<!-- Agregar más validaciones para las otras fotos -->
									</div>
									<a class="carousel-control-prev" href="#carouselExampleIndicators-{{ $paquete->id }}" role="button" data-slide="prev">
										<span class="carousel-control-prev-icon" aria-hidden="true"></span>
										<span class="sr-only">Previous</span>
									</a>
									<a class="carousel-control-next" href="#carouselExampleIndicators-{{ $paquete->id }}" role="button" data-slide="next">
										<span class="carousel-control-next-icon" aria-hidden="true"></span>
										<span class="sr-only">Next</span>
									</a>
								</div>
								@if (Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->editar == 1 && Auth()->user()->id == $paquete->user->id)									
								<button class="btn btn-success col" type="button" data-toggle="modal" data-target="#galeria{{$paquete->id}}">Agregar Nueva Imagen <i class="fas fa-plus"></i></button>
								<div id="galeria{{$paquete->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<form  action="{{url('paquete/foto/')}}"  method="post" class="modal-content" enctype="multipart/form-data">
											<div class="modal-header">
												<h5 class="modal-title" id="my-modal-title">Agregar foto para el paquete: "{{$paquete->nombre}}"</h5>
												<button class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text bg-purple" style="height: 38px; border:1px solid purple;"><i class="fas fa-image"></i></span>
													</div>
													<input type="file" name="foto"  class="form-control py-1" placeholder="ingrece su foto" style="border:1px solid purple;">
													<input type="hidden" name="id_user" value="{{$paquete->user->id}}">
													<input type="hidden" name="id_paquete" value="{{$paquete->id}}">
												</div>
												@csrf
											</div>
											<div class="modal-footer justify-content-between">
												<button type="submit" class="btn btn-outline-success">Guardar</button>
												<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
											</div>

										</form>
									</div>
								</div>
								@endif
								<div class="card-header">
									<div class="container-fluid d-flex justify-content-center">
										<h5 class="card-title mb-1"><strong> {{ strtoupper($paquete->nombre) }}</strong></h5>
									</div>
								</div>
								<div class="row mb-1 container-fluid m-1" >
									<div class="col-md-4">
										<p class="card-text text-truncate mx-1"><small class="text-muted"><strong><i class="fas fa-sun"></i> Días: </strong>{{$paquete->dias}}</small></p>
									</div>
									<div class="col-md-4">
										<p class="card-text text-truncate mx-1"><small class="text-muted"><strong><i class="fas fa-moon"></i> Noches: </strong>{{$paquete->noches}}</small></p>
									</div>
									<div class=" col-md-4">
										<p class="card-text text-truncate mx-1"><small class="text-muted"><strong><i class="fas fa-users"></i> Personas: </strong>{{$paquete->capacidad}}</small></p>
									</div>
									<div class=" col-md-4">
										<p class="card-text text-truncate mx-1"><small class="text-muted"><strong><i class="fas fa-map"></i> Destino: </strong>{{$paquete->destino->nombre}}</small></p>
									</div>
									<div class=" col-md-4">
										<p class="card-text text-truncate mx-1"><small class="text-muted"><strong><i class="fas fa-dollar-sign"></i> Precio: </strong>{{$paquete->precio}}$</small></p>
									</div>
								</div>
								<div class="row mb-0 container-fluid ">

								</div>
								<div class="container-fluid mt-2">
									<p class="card-text mx-3 text-muted"><small><strong>Descripción: </strong></small><span><small class="text-muted">{{$paquete->descripcion}}</small></span></p>

								</div>
								<br>
								<br>
								<div class="row mt-2 mb-1 container-fluid ">
									<div class=" col-md-6">
										<p class="card-text text-truncate mx-1 text-muted"><small><strong>Hotel: </strong>{{isset($paquete->hotel->nombre)?$paquete->hotel->nombre:'No posee'}}</small></p>
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
								<div class="row mt-0 mb-1 container-fluid">
									@if (Auth()->user()->role->administrar_servicios == 1 )
									<div class="col-md-6">
										<p class="card-text text-truncate mx-1 text-muted"><small><strong>Bloqueado: </strong>@if($paquete->bloqueado == 1)
											<span class="text-success">Activo</span>
											@else
											<span class="text-danger">Bloqueado</span>
											@endif
										</small></p>
									</div>
									@endif
									<div class="col-md-6">
										@php
										$verificar = false;
										foreach ($paquete->destacado as $comparacion) {
											if($comparacion->id_user == Auth()->user()->id){
												$verificar = true;
											}

										}
										@endphp
										@if($verificar == false)
										<style>
											.destacado{{$paquete->id}}{
												color: white; 
												-webkit-text-stroke:1px red;
											}
											.destacado{{$paquete->id}}:hover{
												color: red;  
											}
										</style>							
										@else
										<style>
											.destacado{{$paquete->id}}{
												color: red; 
												-webkit-text-stroke:1px red;
											}
											.destacado{{$paquete->id}}:hover{
												color: white;  
											}
										</style>	
										@endif
										<form action="{{url('destacar/'.$paquete->id.'/destacar')}}" method="POST" class="m-0 p-0 col"> @csrf  {{ method_field('PATCH') }} <p class="card-text text-truncate mx-1 text-muted"><small><strong>Destacar</strong><input type="hidden" name="id_user" value="{{Auth()->user()->id}}"> <button type="submit" class="btn m-0 p-0" name="id_paquete" value="{{$paquete->id}}"><i class="fas fa-heart destacado{{$paquete->id}}"></i></button></form></small></p>	
									</div>
								</div>
								<div class="d-flex justify-content-center px-3 py-3 m-0 row">				
									<a href="{{ route('dashboard-package-show',[Str::slug($paquete->nombre),$paquete->id]) }}" class="btn btn-primary col mx-1"><i class="fas fa-eye"></i> Ver Paquete</a>
									@if (Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->editar == 1 && Auth()->user()->id == $paquete->user->id)
									<a href="{{url('/paquete/'.$paquete->id.'/edit')}}" class="btn btn-success"><i class="fas fa-pen-alt"></i></a>
									@endif
									@if (Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->borrar== 1 && Auth()->user()->id == $paquete->user->id)
									<form class="p-0 m-0"  action="{{url('paquete/'.$paquete->id.'/')}}" method="post">
										@csrf
										{{method_field('DELETE')}}
										<button type="submit"  class="btn btn-danger mx-1" onclick="return confirm('¿Quieres borrar {{$paquete->nombre}} de la lista de paquetees?')" value="{{$paquete->id}}"><i class="fas fa-trash-alt"></i></button>
									</form>
									@endif
									@if (Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->bloquear== 1 )
									<form class="p-0 m-0"  action="{{url('paquete/'.$paquete->id.'/bloquear')}}" method="post">
										@csrf
										{{ method_field('PATCH') }}
										@if($paquete->bloqueado == 1)
										<button type="submit" name="status"   class="btn btn-success" onclick="return confirm('¿Quieres bloquear a este hotel?')" value="2"><i class="fas fa-lock-open"></i></button>
										@else 
										<button type="submit" name="status"  class="btn  btn-danger" onclick="return confirm('¿Quieres desbloquear a este hotel?')" value="1"><i class="fas fa-lock"></i></button> 
										@endif
									</form>
									@endif
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

			@section('extra-scripts')

			<!--Barra de busqueda-->
			<script>
				$(document).ready(function() {
  // Función para actualizar el paginado y el filtro de búsqueda
					function actualizarCartas(cantidadCartas) {
    var value = $("#searchInput").val().toLowerCase().trim(); // Obtener el valor del campo de búsqueda
    var encontradas = $(".card").filter(function() {
    	return $(this).text().toLowerCase().replace(/\s+/g, ' ').indexOf(value) > -1;
    }).slice(0, cantidadCartas);

    if (encontradas.length === 0) {
      $("#noResultMessage").show(); // Mostrar el mensaje de "No se encontraron resultados"
  } else {
      $("#noResultMessage").hide(); // Ocultar el mensaje de "No se encontraron resultados"
  }

    $(".card").hide(); // Ocultar todas las cartas
    encontradas.show(); // Mostrar solo las cartas que coinciden con la búsqueda
}

  // Manejar el cambio del select para el paginado
$('#selectPaginado').change(function() {
	var cantidadCartas = $(this).val();
	actualizarCartas(cantidadCartas);
});

  // Manejar el cambio en la barra de búsqueda
$("#searchInput").on("input", function() {
    var cantidadCartas = $('#selectPaginado').val(); // Obtener la cantidad actual de cartas por página
    actualizarCartas(cantidadCartas);
});

  // Llamar a actualizarCartas al cargar la página
  var cantidadCartasDefault = $('#selectPaginado').val(); // Obtener la cantidad por defecto
  actualizarCartas(cantidadCartasDefault); // Aplicar el paginado al cargar la página
});
</script>

@endsection

@endsection