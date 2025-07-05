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
							<div class="float-sm-right ml-2">
								<a href="{{url('card/hoteles')}}" class="btn btn-primary"><i class="fas fa-address-card"> </i></a>
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

			<!--TABLE-->
			<div class="container-fluid">
				<table class="table table-light table-hover text-center">
					<thead class="bg-purple text-dark">
						<tr>
							<th class="col-md-2 py-3">Foto</th>
							<th class="col-md-2 py-3">Nombre</th>
							<th class="col-md-2 py-3">Descripcion</th>
							<th class="col-md-2 py-3">Estado</th>
							<th class="col-md-2 py-3">Ubicación</th>
							@if ( Auth()->user()->role->administrar_servicios == 1 && (Auth()->user()->role->borrar == 1 || Auth()->user()->role->editar == 1 || Auth()->user()->role->bloqueado == 1))
							<th class="col-md-2 py-3">Acciones</th>
							@endif
						</tr>
					</thead>
					<tbody>
						@if ( isset($hoteles) && count($hoteles) > 0)
						@foreach ($hoteles as $hotel)
						<tr>
							<td class="col-md-2"><img src="{{asset('storage'.'/'.$hotel->foto)}}" alt="" height="100px" width="100px" class="rounded rounded-circle"></td>
							<td class="col-md-2"><p>{{$hotel->nombre}}</p></td>
							<td class="col-md-2"><p>{{ Str::limit($hotel->descripcion, 50) }}</p></td>
							<td class="col-md-2">@if($hotel->estado == 1)
								<p class="text-success">Activo</p>
								@else
								<p class="text-danger">Inactivo</p>
							@endif</td>
							<td class="col-md-2"><p>{{$hotel->destino->nombre}}</p></td>
							@if ( Auth()->user()->role->administrar_servicios == 1 && (Auth()->user()->role->borrar == 1 || Auth()->user()->role->editar == 1 || Auth()->user()->role->bloqueado == 1))
							<td class="col-md-2">
								<div class="d-flex justify-content-center align-items-center" style="margin-top:20px;">
									<!-- formulario para la ruta borrar-->
									<!-- ruta para editar-->
									@if (Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->editar == 1 && Auth()->user()->id == $hotel->user->id)
									<a href="{{url('/hotel/'.$hotel->id.'/edit')}}" class="btn btn-success"><i class="fas fa-pen-alt"></i></a>
									@endif
									@if (Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->borrar == 1 && Auth()->user()->id == $hotel->user->id)
									<form class="mx-1" action="{{url('hotel/'.$hotel->id.'/')}}" method="post">
										@csrf
										{{method_field('DELETE')}}
										<button type="submit"  class="btn btn-danger" onclick="return confirm('¿Quieres borrar {{$hotel->nombre}} de la lista de hoteles?')" value="{{$hotel->id}}"><i class="fas fa-trash-alt"></i></button>
									</form>
									@endif
									<!-- formulario para la ruta de bloquear-->
									@if (Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->bloquear == 1)    
									<form class="mx-1" action="{{url('hotel/'.$hotel->id.'/bloquear' )}}" method="post">   
										@csrf  
										{{ method_field('PATCH') }}
										@if($hotel->bloqueado == 1)
										<button type="submit" name="status"   class="btn btn-success" onclick="return confirm('¿Quieres bloquear a este hotel?')" value="2"><i class="fas fa-lock-open"></i></button>
										@else 
										<button type="submit" name="status"  class="btn  btn-danger" onclick="return confirm('¿Quieres desbloquear a este hotel?')" value="1"><i class="fas fa-lock"></i></button> 
										@endif
									</form>
								</div>
								@endif
							</td>
							@endif
						</tr>
						@endforeach  
						@else
						<tr>
							<td class="col-md-2">No existen datos disponibles</td>
							<td class="col-md-2">No existen datos disponibles</td>
							<td class="col-md-2">No existen datos disponibles</td>
							<td class="col-md-2">No existen datos disponibles</td>
							<td class="col-md-2">No existen datos disponibles</td>
							@if ( Auth()->user()->role->administrar_servicios == 1 && (Auth()->user()->role->borrar == 1 || Auth()->user()->role->editar == 1 || Auth()->user()->role->bloqueado == 1))
							<td class="col-md-2">No existe aciones disponibles</td>
							@endif
						</tr>
						@endif
					</tbody>
					<tr id="noResultRow" style="display: none;">
						<td colspan="12"><h4>No se encontraron resultados</h4></td>
					</tr>
				</table>
			</div>
		</div>
		<!--PAGINATE
		<div class="container-fluid mt-3 pb-4">
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
</div>
</div>

@section('extra-scripts')

<!--Barra de busqueda-->
<script>
	$(document).ready(function() {
  // Función para actualizar el paginado y el filtro de búsqueda
		function actualizarTabla(cantidadFilas) {
    var value = $("#searchInput").val().toLowerCase().trim(); // Obtener el valor del campo de búsqueda
    $("table tbody tr").hide(); // Ocultar todas las filas
    
    // Filtrar las filas por el valor de búsqueda y mostrar solo las necesarias según el paginado
    $("table tbody tr").filter(function() {
    	return $(this).text().toLowerCase().replace(/\s+/g, ' ').indexOf(value) > -1;
    }).slice(0, cantidadFilas).show(); // Mostrar las primeras "cantidadFilas" filas que coinciden con la búsqueda

    if ($("table tbody tr:visible").length === 0) {
    	$("#noResultRow").show();
    } else {
    	$("#noResultRow").hide();
    }
  }

  // Manejar el cambio del select para el paginado
  $('#selectPaginado').change(function() {
  	var cantidadFilas = $(this).val();
  	actualizarTabla(cantidadFilas);
  });

  // Manejar el cambio en la barra de búsqueda
  $("#searchInput").on("input", function() {
    var cantidadFilas = $('#selectPaginado').val(); // Obtener la cantidad actual de filas por página
    actualizarTabla(cantidadFilas);
  });


    // Llamar a actualizarTabla al cargar la página
    var cantidadFilasDefault = $('#selectPaginado').val(); // Obtener la cantidad por defecto
    actualizarTabla(cantidadFilasDefault); // Aplicar el paginado al cargar la página
  });
</script>

@endsection

@endsection 