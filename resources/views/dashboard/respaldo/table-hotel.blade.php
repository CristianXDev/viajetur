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
							<div class="float-sm-right">
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

			<!--TABLE-->
				<table class="table-light table-hover text-center">
					<thead class="bg-purple text-dark">
						<tr>
							<th class="col-md-2 py-3">Foto</th>
							<th class="col-md-2 py-3">Nombre</th>
							<th class="col-md-2 py-3">Descripcion</th>
							<th class="col-md-2 py-3">Estado</th>
							<th class="col-md-2 py-3">Ubicación</th>
							<th class="col-md-2 py-3">Acciones</th>
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
							<td class="col-md-2">

								<form class="conteiner-fluid"  action="{{url('hotel/'.$hotel->id.'/')}}" method="post">

									<a href="{{url('/hotel/'.$hotel->id.'/edit')}}" class="btn btn-success"><i class="fas fa-pen-alt"></i></a>
									@csrf
									{{method_field('DELETE')}}

									<button type="submit"  class="btn btn-danger" onclick="return confirm('¿Quieres borrar {{$hotel->nombre}} de la lista de hoteles?')" value="{{$hotel->id}}"><i class="fas fa-trash-alt"></i></button>

								</form>
							</td>
						</tr>
						@endforeach  
						@else
						<tr>
							<td class="col-md-2">No existen datos disponibles</td>
							<td class="col-md-2">No existen datos disponibles</td>
							<td class="col-md-2">No existen datos disponibles</td>
							<td class="col-md-2">No existen datos disponibles</td>
							<td class="col-md-2">No existen datos disponibles</td>
							<td class="col-md-2">No existe aciones disponibles</td>
						</tr>
						@endif

					</tbody>
				</table>
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


@endsection 