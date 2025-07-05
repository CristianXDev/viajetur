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
							<div class="pb-4 m-0">
								<form class="row d-flex justify-content-center text-white" action="{{url('destino/'.$destino->id.'/')}}" method="post">
									<a href="{{url('/destino/'.$destino->id)}}" class="btn btn-primary" style="margin: 2px">SELECCIONAR</a>
									<a href="{{url('/destino/'.$destino->id.'/edit')}}" class="btn btn-success" style="margin: 2px"><i class="fas fa-pencil-alt"></i></a>

									@csrf
									{{method_field('DELETE')}}

									<button type="submit"  class="btn btn-danger" style="margin: 2px" onclick="return confirm('¿Quieres borrar {{$destino->nombre}} de la lista de destino?')" value="{{$destino->id}}"><i class="fas fa-trash"></i></button>
								</form>
							</div>
						</div>
					</div>
					@endforeach

				</div>
			</div>
		</div>



		@endsection