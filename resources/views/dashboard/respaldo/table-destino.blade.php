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
								<a href="{{url('card/destino')}}" class="btn btn-primary"><i class="fas fa-address-card"> </i></a>
							</div>
							<div class="float-sm-right">
								<a href="{{url('destino/create')}}" class="btn btn-success">AGREGAR</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!--SEARCH
			<div class="container mb-4">
				<div class="container">
					<div class="row">
						<div class="col">
							<input type="text" class="form-control" placeholder="Destino...">
						</div>
						<div class="col">
							<input type="text" class="form-control" placeholder="Descripción...">
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


			<!--TABLE-->
			<div class="container">
				<table class="table table-light table-hover text-center">
					<thead class="bg-purple text-dark">
						<tr>
							<th class="col-md-2">Foto</th>
							<th class="col-md-2">Nombre</th>
							<th class="col-md-2">Ubicación</th>
							<th class="col-md-2">Acciones</th>
						</tr>
					</thead>
					<tbody>
						@if ( isset($destinos) && count($destinos) > 0)
						@foreach ($destinos as $destino)
						<tr>
							<td class="col-md-2"><img src="{{ asset('storage'.'/'.$destino->foto)}}"width="100" height="100" class="rounded rounded-circle"></p></td>
							<td class="col-md-2"><p>{{$destino->nombre}}</p></td>
							<td class="col-md-2"><p>{{$destino->estado->nombre}}</p></td>
							<td class="col-md-2">

							<form class="container-fluid" action="{{url('destino/'.$destino->id.'/')}}" method="post">

								<a href="{{url('/destino/'.$destino->id.'/edit')}}" class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>

								@csrf
								{{method_field('DELETE')}}

								<button type="submit"  class="btn btn-danger" onclick="return confirm('¿Quieres borrar {{$destino->nombre}} de la lista de destino?')" value="{{$destino->id}}"><i class="fas fa-trash"></i></button>
							</form>
							
							</td>
						</tr>
						@endforeach  
						@else
						<tr>
							<td class="col-md-1">No existen datos disponibles</td>
							<td class="col-md-2">No existen datos disponibles</td>
							<td class="col-md-1">No existen datos disponibles</td>
							<td class="col-md-1">No existe aciones disponibles</td>
						</tr>
						@endif
					</tbody>
				</table>
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
		</div>
	</div>
</div>

@endsection
