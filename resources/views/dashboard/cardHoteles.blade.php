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

								@if ( Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->agregar == 1)
								<div class="float-sm-right">
									<a href="{{url('hotel/create')}}" class="btn btn-success">AGREGAR</a>
								</div>
								@endif
							</div>
						</div>
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

			<!--CARD-->
			<div class="container-fluid">
				<div class="container">
					<div class="row">
						@foreach ($hoteles as $hotel)			
						<div class="col-lg-6 mb-4">
							<div class="card">
								<div class="card-header text-center p-0">
									<div id="carouselExampleIndicators-{{ $hotel->id }}" class="carousel slide" data-ride="carousel">
										<ol class="carousel-indicators">
											<li data-target="#carouselExampleIndicators-{{ $hotel->id }}" data-slide-to="0" class="active"></li>
											@if (count($hotel->fotoHotel) > 0)
											@php
											for ($i=0; $i < count($hotel->fotoHotel); $i++) { 
												# code...
												echo '<li data-target="#carouselExampleIndicators-{{ $hotel->id }}" data-slide-to="1"></li>';
											}

											@endphp


											@endif
											<!-- Agregar más validaciones para las otras fotos -->
										</ol>
										<div class="carousel-inner">
											<div class="carousel-item active">
												<img src="{{ asset('storage'.'/'.$hotel->foto) }}" class="d-block w-100" height="400" alt="...">

											</div>
											@if (count($hotel->fotoHotel) > 0)
											@foreach ($hotel->fotoHotel as $foto)											
											<div class="carousel-item">
												<img src="{{ asset('storage'.'/'.$foto->foto) }}" class="d-block w-100" height="400" alt="...">
												@if (Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->editar == 1 && Auth()->user()->id == $hotel->user->id)
												<form class="m-0 p-0"  action="{{url('hotel/foto/'.$foto->id)}}" style="position: absolute; top:3%; left:75%;" method="post">									
													<!-- complemento pra el formulario para la ruta borrar imagenes del hotel-->
													@csrf
													<input type="hidden" name="id_user" value="{{$hotel->user->id}}">
													<input type="hidden" name="id_hotel" value="{{$hotel->id}}">

													{{ method_field('PATCH') }}
													<button type="submit"  class="btn btn-danger" onclick="return confirm('¿Quieres borrar la imagen de la galeria del hotel {{$hotel->nombre}}?')" ><i class="fas fa-trash-alt"></i></button>
												</form>
												@endif
											</div>
											@endforeach
											@endif


											<!-- Agregar más validaciones para las otras fotos -->
										</div>
										<a class="carousel-control-prev" href="#carouselExampleIndicators-{{ $hotel->id }}" role="button" data-slide="prev">
											<span class="carousel-control-prev-icon" aria-hidden="true"></span>
											<span class="sr-only">Previous</span>
										</a>
										<a class="carousel-control-next" href="#carouselExampleIndicators-{{ $hotel->id }}" role="button" data-slide="next">
											<span class="carousel-control-next-icon" aria-hidden="true"></span>
											<span class="sr-only">Next</span>
										</a>
									</div>
									@if (Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->editar == 1 && Auth()->user()->id == $hotel->user->id)									
									<button class="btn btn-success col" type="button" data-toggle="modal" data-target="#galeria{{$hotel->id}}">Agregar Nueva Imagen <i class="fas fa-plus"></i></button>
									<div id="galeria{{$hotel->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<form  action="{{url('hotel/foto/')}}"  method="post" class="modal-content" enctype="multipart/form-data">
												<div class="modal-header">
													<h5 class="modal-title" id="my-modal-title">Agregar foto para el hotel:  "{{$hotel->nombre}}"</h5>
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
														<input type="hidden" name="id_user" value="{{$hotel->user->id}}">
														<input type="hidden" name="id_hotel" value="{{$hotel->id}}">
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
									<div class="container-fluid d-flex justify-content-center my-3">
										<h5 class="card-title mb-1"><strong> {{ strtoupper($hotel->nombre) }}</strong></h5> 
									</div>
								</div>
								<div class="card-body m-0 py-0">

									<div class="row mb-0 container-fluid my-3">
										<div class="col-md-12 text-center">
											<p class="card-text text-truncate mx-1 text-muted"><strong>Clase: </strong>
												@for ($i = 0; $i < 5; $i++)
												@if ($i < $hotel->categoria)
												<i class="fas fa-star text-warning"></i>
												@else
												<i class="fas fa-star "></i>
												@endif	
												@endfor
											</p>
										</div>
									</div>

									<div class="text-center">
										<p class="card-text text-truncate mx-1 text-muted"><i class="fa fa-phone text-info"></i><strong>: </strong>{{isset($hotel->telefono)?$hotel->telefono:'No posee'}}</small></p>
									</div>

									<p class="my-4 text-muted"><small><strong>Descripción: </strong></small><span class="text-muted"><small>{{$hotel->descripcion}}</small></span></p>

									<div class="row">
										<div class="col-md-6">
											<p class="card-text mx-1 text-muted"><small><strong>Ubicación:</strong>{{$hotel->destino->nombre}}</small></p>
										</div>

										<div class="col-md-6">
											<p class="card-text mx-1 text-muted"><small><strong>Estado: </strong>@if($hotel->estado == 1)
												<span class="text-success">Activo</span>
												@else
												<span class="text-danger">Inactivo</span>
											@endif</small></p>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											<p class="card-text mx-1 text-muted"><small><strong>Vistas:</strong> ({{$hotel->vistas}})</small></p>
										</div>
										<div class="col-md-6">
											@if (Auth()->user()->role->administrar_servicios == 1 )
											<p class="card-text text-truncate mx-1 text-muted"><small><strong>Bloqueado: </strong>@if($hotel->bloqueado == 1)
												<span class="text-success">Activo</span>
												@else
												<span class="text-danger">Bloqueado</span>
												@endif
											</small></p>
											@endif
										</div>
									</div>



								</div>
								<div class="container-fluid px-4 pt-3 pb-4 row">				

									<a href="{{ route('dashboard-hotel-show',[Str::slug($hotel->nombre),$hotel->id]) }}" class="btn btn-primary col mx-1"><i class="fas fa-eye"></i> Ver Hotel</a>
									<!-- ruta para editar-->
									@if (Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->editar == 1 && Auth()->user()->id == $hotel->user->id)
									<a href="{{url('/hotel/'.$hotel->id.'/edit')}}" class="btn btn-success"><i class="fas fa-pen-alt"></i></a>
									@endif
									@if (Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->borrar == 1 && Auth()->user()->id == $hotel->user->id)
									<form class="m-0 p-0"  action="{{url('hotel/'.$hotel->id.'/')}}" method="post">									
										<!-- complemento pra el formulario para la ruta borrar-->
										@csrf
										{{method_field('DELETE')}}
										<button type="submit"  class="btn btn-danger mx-1" onclick="return confirm('¿Quieres borrar {{$hotel->nombre}} de la lista de hoteles?')" value="{{$hotel->id}}"><i class="fas fa-trash-alt"></i></button>
									</form>
									@endif
									@if (Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->bloquear == 1)    
									<form class="m-0 p-0" action="{{url('hotel/'.$hotel->id.'/bloquear' )}}" method="post">   
										@csrf  
										{{ method_field('PATCH') }}
										@if($hotel->bloqueado == 1)
										<button type="submit" name="status"   class="btn btn-success" onclick="return confirm('¿Quieres bloquear a este hotel?')" value="2"><i class="fas fa-lock-open"></i></button>
										@else 
										<button type="submit" name="status"  class="btn  btn-danger" onclick="return confirm('¿Quieres desbloquear a este hotel?')" value="1"><i class="fas fa-lock"></i></button> 
										@endif
									</form>
									@endif

								</div>
							</div>
						</div>

						@endforeach
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