@extends('sources-dashboard')

@section('head-title')

<title>VIAJETUR | {{ strtoupper($packageName); }}</title>

@endsection

@section('content')

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDaeWicvigtP9xPv919E-RNoxfvC-Hqik&callback=iniciarMap"></script>

<!--TITLE BODY-->
<div class="wrapper">
	<div class="content-wrapper">
		<div class="container">
			<div class="content-header mb-4">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h4 class="m-0"><i class="fas fa-cube"></i> {{ strtoupper($packageName); }}</h4>
						</div>
						<div class="col-sm-6">

							<div class="float-sm-right">
								<a href="{{ url('/paquete') }}" class="btn btn-dark">REGRESAR</a>
							</div>

						</div>
					</div>
				</div>
			</div>


			<div class="container-fluid">
				<div class="container">
					<div class="row">
						<div class="col-sm-10 mx-auto">
							<div class="card">
								<div id="carouselExampleIndicators-{{ $paquete->id }}"  data-interval="false" class="carousel slide" data-ride="carousel">
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
								<div class="card-header text-center">
									<div class="container-fluid d-flex justify-content-center">
										<h5 class="card-title mb-1"><strong> {{ strtoupper($paquete->nombre) }}</strong></h5>
									</div>
								</div>
								<div class="row mb-1 container-fluid m-1" >
									<div class="col-md-3">
										<p class="card-text text-truncate mx-1"><small class="text-muted"><strong><i class="fas fa-sun"></i> Días: </strong>{{$paquete->dias}}</small></p>
									</div>
									<div class="col-md-3">
										<p class="card-text text-truncate mx-1"><small class="text-muted"><strong><i class="fas fa-moon"></i> Noches: </strong>{{$paquete->noches}}</small></p>
									</div>
									<div class=" col-md-3">
										<p class="card-text text-truncate mx-1"><small class="text-muted"><strong><i class="fas fa-users"></i> Personas: </strong>{{$paquete->capacidad}}</small></p>
									</div>
									<div class=" col-md-3">
										<p class="card-text text-truncate mx-1"><small class="text-muted"><strong><i class="fas fa-map"></i> Destino: </strong>{{$paquete->destino->nombre}}</small></p>
									</div>
								</div>

								<div class="container-fluid my-3 text-center">
									<p class="card-text m-0"><small class="text-muted"><strong class="text-md">Descripcion: </strong></small> <span class="text-sm text-muted">{{$paquete->descripcion}}</span></p>
								</div>

								<div class="row mt-2 mb-2 container-fluid ">
									<div class="col-md-6">
										<p class="card-text text-truncate mx-1 text-muted"><strong>Hotel: </strong>{{isset($paquete->hotel->nombre)?$paquete->hotel->nombre:'No posee'}}</p>
									</div>
									<div class="col-md-6">
										<p class="card-text text-truncate mx-1 text-muted"><strong>Precio: </strong>{{ $paquete->precio }}$</p>
									</div>
								</div>
								<div class="row mt-0 mb-2 container-fluid">
									<div class="col-md-6">
										<p class="card-text text-truncate mx-1 text-muted"><strong>Vistas:( </strong>{{$paquete->vistas}} Vistas<strong>)</strong></p>	
									</div>
									<div class="col-md-6">
										<p class="card-text text-truncate mx-1 text-muted"><strong>Reservas: </strong>( {{$paquete->reservas}} Reservas<strong>)</strong></p>	
									</div>
								</div>

								@if (count($paquete->videoPaquete) > 0)
								<div class="container-fluid text-center mt-5">
									<h4 class="text-muted"><strong>Video del paquete</strong>
									</h4>
								</div>


								<div id="carouselExampleIndicators-{{ $paquete->id }}2" class="carousel slide" data-ride="carousel">
									<ol class="carousel-indicators">

										@if (count($paquete->videoPaquete) > 0)
										@php
										for ($i=0; $i < count($paquete->videoPaquete); $i++) { 
											# code...
											echo '<li data-target="#carouselExampleIndicators-{{ $hotel->id }}" data-slide-to="1"></li>';
										}

										@endphp


										@endif
										<!-- Agregar más validaciones para las otras fotos -->
									</ol>
									<div class="carousel-inner">
										@if (count($paquete->videoPaquete) > 0)
										@php
										if(!isset($active)){
											$active = 0;
										}
										@endphp
										@foreach ($paquete->videoPaquete as $video)											
										<div class="carousel-item @if($active == 0) active @endif">
											<video  controls muted class="w-100 my-4">
												<source  src="{{asset('storage'.'/'.$video->video)}}" type="video/mp4" width="100%" height="100%">
												</video>
											</div>
											@php

											$active = 1;

											@endphp
											@endforeach
											@if (Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->editar == 1 && Auth()->user()->id == $paquete->user->id)
											<form class="m-0 p-0"  action="{{url('paquete/video/'.$video->id)}}" style="position: absolute; top:10%; left:85%;" method="post">									
												<!-- complemento pra el formulario para la ruta borrar imagenes del hotel-->
												@csrf
												<input type="hidden" name="id_user" value="{{$paquete->user->id}}">
												<input type="hidden" name="id_paquete" value="{{$paquete->id}}">

												{{ method_field('PATCH') }}
												<button type="submit"  class="btn btn-danger" onclick="return confirm('¿Quieres borrar la imagen de la galeria del hotel {{$paquete->nombre}}?')" ><i class="fas fa-trash-alt"></i></button>
											</form>
											@endif
											@endif


											<!-- Agregar más validaciones para las otras fotos -->
										</div>
										<a class="carousel-control-prev" href="#carouselExampleIndicators-{{ $paquete->id }}2" style="background-color:transparent; height:50px ; width: 50px; margin-top: 35%;border-radius: 100%; margin-left: 10px " role="button" data-slide="prev">
											<span class="carousel-control-prev-icon" aria-hidden="true"></span>
											<span class="sr-only">Previous</span>
										</a>
										<a class="carousel-control-next" href="#carouselExampleIndicators-{{ $paquete->id }}2"style="background-color:transparent; height:50px ; width: 50px; margin-top: 35%;border-radius: 100%; margin-right: 10px; " role="button" data-slide="next">
											<span class="carousel-control-next-icon" aria-hidden="true"></span>
											<span class="sr-only">Next</span>
										</a>
									</div>
									@endif

									@if (Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->editar == 1 && Auth()->user()->id == $paquete->user->id)									
									<button class="btn btn-success col" type="button" data-toggle="modal" data-target="#galeria{{$paquete->id}}">Agregar Nuevo Video <i class="fas fa-plus"></i></button>
									<div id="galeria{{$paquete->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<form  action="{{url('paquete/video/')}}"  method="post" class="modal-content" enctype="multipart/form-data">
												<div class="modal-header">
													<h5 class="modal-title" id="my-modal-title">Agregar video para el paquete {{$paquete->nombre}}</h5>
													<button class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<div class="input-group mb-3">
														<div class="input-group-prepend">
															<span class="input-group-text bg-purple" style="height: 38px; border:1px solid purple;"><i class="fas fa-image"></i></span>
														</div>
														<input type="file" name="video"  class="form-control py-1" placeholder="ingrece su foto" style="border:1px solid purple;">
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
									<div class="my-5 text-center">
										<a href="{{ route('dashboard-package-proforma',[Str::slug($paquete->nombre),$paquete->id]) }}" class="btn btn-outline-primary">COMPRAR</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				@endsection