@extends('sources-dashboard')

@section('head-title')

<title>VIAJETUR | TIPO DE PAQUETES</title>

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
							<h4 class="m-0"><i class="fas fa-cube"></i> TIPOS DE PAQUETES DISPONIBLES</h4>
						</div>
						<div class="col-sm-6">
							<div class="float-sm-right">
								<a href="{{url('tipoPaquete/create')}}" class="btn btn-success">AGREGAR</a>
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
						<input type="text" class="form-control" placeholder="Tipo De Paquete...">
					</div>
					<div class="col">
						<input type="color" class="form-control" placeholder="Color...">
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
						<th class="col-md-3">Tipo De Paquete</th>
						<th class="col-md-3">vista</th>
						<th class="col-md-3">Color De La Clase</th>
						<th class="col-md-3">Acciones</th>
					</tr>

				</thead>
				<tbody>

					@if ( isset($tipoPaquetes) && count($tipoPaquetes) > 0)
					@foreach ($tipoPaquetes as $tipoPaquete)					
					<tr>
					<td class="col-md-3"><a href="{{url('/tipoPaquete/'.$tipoPaquete->id)}}" class=""><p>{{$tipoPaquete->nombre}}</p></a></td>
					<td class="col-md-3"><p>{{$tipoPaquete->vistas}}</p></td>
					<td class="col-md-3"> <i class="fas fa-cube" style="color:{{ $tipoPaquete->color }} ;"></td>
					<td class="col-md-3">
							
						<form class="conteiner-fluid"  action="{{url('tipoPaquete/'.$tipoPaquete->id.'/')}}" method="post">
							<a href="{{url('/tipoPaquete/'.$tipoPaquete->id.'/edit')}}" class="btn btn-success"><i class="fas fa-pen-alt"></i></a>
							@csrf
							{{method_field('DELETE')}}
							<button type="submit"  class="btn btn-danger" onclick="return confirm('¿Quieres borrar {{$tipoPaquete->nombre}} de la lista de tipos de paquetes?')" value="{{$tipoPaquete->id}}"><i class="fas fa-trash-alt"></i></button>
						</form>

					</td>

					@endforeach  
					@else
					<td class="col-md-3"><p>No existen datos disponibles</p></td>
					<td class="col-md-3"><p>No existen datos disponibles</p></td>
					<td class="col-md-3"><p>No existen datos disponibles</p></td>
					<td class="col-md-3"><p>No existe aciones disponibles</p></td>
					@endif
				</tbody>
			</table>

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