@extends('sources-dashboard')

@section('head-title')

<title>VIAJETUR | DESTINOS</title>

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
							<h4 class="m-0"><i class="fas fa-map-marker-alt"></i> DESTINOS DISPONIBLES</h4>
						</div>
						<div class="col-sm-6">
							<div class="float-sm-right ml-2">
								<a href="{{url('/destino')}}" class="btn btn-primary"><i class="fas fa-table"> </i></a>
							</div>
							@if ( Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->agregar == 1)
							<div class="float-sm-right">
								<a href="{{url('destino/create')}}" class="btn btn-success">AGREGAR</a>
							</div>
							@endif
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
						@foreach ($destinos as $destino)
						<div class="col-lg-6 mb-4">
							<div class="card">
								<div class="card-header m-0 p-0">
									<img src="{{ asset('storage'.'/'.$destino->foto) }}" class="card-img-top" style="height:400px;">
									<div class="col-md-12 d-flex justify-content-center ">
										<h5 class="card-title my-3"><strong> {{strtoupper($destino->nombre)}}</strong></h5>
									</div>
								</div>
								<div class="card-body p-0">
									<div class="my-3 ml-2 container-fluid row">
										<div class="col-md-6">
											<div class="m-0 p-0">
												<p class="card-text text-muted"><strong>Ubicación:</strong> {{  $destino->estado->nombre}}</p>
											</div>
										</div>
										<div class="col-md-6">
											<div class="m-0 p-0">
												<p class="card-text text-muted"><strong>Vistas:</strong> {{$destino->vistas}}</p>
											</div>
										</div>
									</div>
								</div>
								<div class="container-fluid row px-4 pb-3 justify-content-center">

									@if (Auth()->user()->role->administrar_destinos == 1 && Auth()->user()->role->editar == 1)
									<a href="{{url('/destino/'.$destino->id.'/edit')}}" class="btn btn-success" style="margin: 2px"><i class="fas fa-pencil-alt"></i></a>
									@endif
									@if (Auth()->user()->role->administrar_destinos == 1 && (Auth()->user()->role->editar == 1 || Auth()->user()->role->borrar == 1))	
									<form class="p-0 m-0" action="{{url('destino/'.$destino->id.'/')}}" method="post">

										@csrf
										{{method_field('DELETE')}}

										<button type="submit"  class="btn btn-danger" style="margin: 2px" onclick="return confirm('¿Quieres borrar {{$destino->nombre}} de la lista de destino?')" value="{{$destino->id}}"><i class="fas fa-trash"></i></button>
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