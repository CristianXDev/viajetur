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
							<div class="float-sm-right ml-2">
								<a href="{{url('card/habitaciones')}}" class="btn btn-primary"><i class="fas fa-address-card"> </i></a>
							</div>
							<div class="float-sm-right">
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

		<!--TABLE-->
		<div class="container-fluid">
			<table class="table table-light table-hover text-center table-responsive">
				<thead class="bg-purple text-dark">
					<tr>
						<th class="col-md-1">Foto</th>
						<th class="col-md-1">N° de habitación</th>
						<th class="col-md-1">Capacidad</th>
						<th class="col-md-1">Tipo</th>
						<th class="col-md-1">Comodidades</th>
						<th class="col-md-1">Hotel</th>
						<th class="col-md-1">Acciones</th>
					</tr>
				</thead>
				<tbody>
					@if ( isset($habitaciones) && count($habitaciones) > 0)
					@foreach ($habitaciones as $habitacion)
					<tr>
						<td class="col-md-1"><img src="{{asset('storage'.'/'.$habitacion->foto)}}" alt="" height="100" width="100" class="rounded rounded-circle"></td>
						<td class="col-md-1"><p>{{$habitacion->num_habitacion}}</p></td>
						<td class="col-md-1"><p>{{$habitacion->capacidad}}</p></td>
						<td class="col-md-1"><p>{{$habitacion->tipo}}</p></td>
						<td class="col-md-1"><p>{{$habitacion->comodidades}}</p></td>
						<td class="col-md-1"><p>{{$habitacion->hotel->nombre}}</p></td>
						<td class="col-md-1">
							<form class="conteiner-fluid"  action="{{url('habitacion/'.$habitacion->id.'/')}}" method="post">
								<a href="{{url('/habitacion/'.$habitacion->id.'/edit')}}" class=" btn btn-success"><i class="fas fa-pen-alt"></i></a>
								@csrf
								{{method_field('DELETE')}}
								<button type="submit"  class="btn btn-danger" onclick="return confirm('¿Quieres borrar {{$habitacion->nombre}} de la lista de habitaciones?')" value="{{$habitacion->id}}"><i class="fas fa-trash-alt"></i></button>
							</form></p></td>
						</tr>
						@endforeach  
						@else
						<tr>
							<td class="col-md-1">No existen datos disponibles</td>
							<td class="col-md-1">No existen datos disponibles</td>
							<td class="col-md-1">No existen datos disponibles</td>
							<td class="col-md-1">No existen datos disponibles</td>
							<td class="col-md-1">No existen datos disponibles</td>
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
