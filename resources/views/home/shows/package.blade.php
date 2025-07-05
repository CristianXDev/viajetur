@extends('sources-home')

@section('head-title')

<title>VIAJETUR | {{ strtoupper($packageName) }}</title>

@endsection

@section('content-home')

<body>


	<div id="siteLoader" class="site-loader">
		<div class="preloader-content">
			<img src="{{ asset('static/images/loader1.gif')}}" alt="">
		</div>
	</div>
	<div id="page" class="full-page">
		<header id="masthead" class="site-header header-primary">

			@include('layouts.navbar.nav-home')

			<div class="mobile-menu-container"></div>
		</header>

	</div>

	<div class="container-fluid d-flex justify-content-center align-items-center" style=" background:linear-gradient(rgba(0,0,0,0.25),rgba(0,0,0,0.1)),url('{{ asset("storage"."/".$paquete->foto) }}'); background-size:cover; height:500px;">
		<div class="text-center mt-5" data-aos="fade-up" data-aos-once="true">
			<h2 class="text-white">{{strtoupper($paquete->nombre)}}</h2>

			@auth
			<a href="{{ route('dashboard-package-show',[Str::slug($paquete->nombre),$paquete->id]) }}" class="btn btn-primary mt-3">Reservar</a>
			@endauth

			@guest
			<a href="{{ route('login') }}" class="btn btn-primary mt-3">Inicia sesión para reservar</a>
			@endguest
		</div>
	</div>


	<div class="container">
		<div class="row py-3">
			<div class="col-6">
				<p class="text-dark"><i class="fas fa-cube"></i><strong> PAQUETE:</strong> {{ strtoupper($packageName); }}</p>
			</div>
			<div class="col-6">
				<p class="text-dark"><i class="fas fa-eye"></i><strong> VISTAS:</strong> {{$paquete->vistas}}</p>
			</div>
		</div>
	</div>

	<!--DESCIPTION-->
	<div class="container mt-5 mb-3">
		<div class="row">
			<div class="col-md-6">
				<h2>Descripción Del Paquete</h2>
				<p class="">{{ $paquete->descripcion }}</p>
			</div>
			<div class="col-md-6">
				<div id="carouselExampleIndicators-{{ $paquete->id }}" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#carouselExampleIndicators-{{ $paquete->id }}" data-slide-to="0" class="active"></li>
						@if (count($paquete->fotoPaquete) > 0)
						@php
						for ($i=0; $i < count($paquete->fotoPaquete); $i++) { 
							# code...
							echo '<li data-target="#carouselExampleIndicators-{{ $paquete->id }}" data-slide-to="1"></li>';
						}

						@endphp


						@endif
						<!-- Agregar más validaciones para las otras fotos -->
					</ol>
					<div class="carousel-inner">
						<div class="carousel-item active">
							<img src="{{ asset('storage'.'/'.$paquete->foto) }}" class="d-block w-100" style="height:400px;" alt="...">

						</div>
						@if (count($paquete->fotoPaquete) > 0)
						@foreach ($paquete->fotoPaquete as $foto)											
						<div class="carousel-item">
							<img src="{{ asset('storage'.'/'.$foto->foto) }}" class="d-block w-100" style="height:400px;" alt="...">
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
			</div>
		</div>
	</div>
</div>

@if(isset($paquete->videoPaquete))

<!--VIDEOS PAQUETES-->
<div class="container mt-5 mb-3 text-center">

	<div class="col-md-12">
		@if (count($paquete->videoPaquete) > 0)

		<div class="pt-5 text-center">
			<h2>Video Del Paquete</h2>
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
		</div>
	</div>

	@endif

	@if(isset($paquete->hotel))

	<!--HOTEL-->
	<div class="container mt-5 mb-3 text-center">

		<div class="text-center">
			<h2>Hotel Del Paquete</h2>
			<h4>( {{$paquete->hotel->nombre}} )</h4>
			<p class="card-text text-truncate mx-1 text-muted"><strong>Clase: </strong>
				@for ($i = 0; $i < 5; $i++)
				@if ($i < $paquete->hotel->categoria)
				<i class="fas fa-star text-warning"></i>
				@else
				<i class="fas fa-star "></i>
				@endif	
			@endfor</p>
		</div>

		<div class="container  mt-5 mb-3 text-center">
			<div class="row">
				<div class="col-md-6">
					<div id="carouselExampleIndicators-2"  data-interval="false" class="carousel slide my-3" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
							@if (count($paquete->hotel->fotoHotel) > 0)
							@php
							for ($i=0; $i < count($paquete->hotel->fotoHotel); $i++) { 
								# code...
								echo '<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>';
							}
							@endphp


							@endif
							<!-- Agregar más validaciones para las otras fotos -->
						</ol>
						<div class="carousel-inner">
							<div class="carousel-item active">
								<img src="{{ asset('storage'.'/'.$paquete->hotel->foto) }}" class="d-block w-100" style="height:400px;" alt="...">

							</div>
							@if (count($paquete->hotel->fotoHotel) > 0)
							@foreach ($paquete->hotel->fotoHotel as $foto)											
							<div class="carousel-item">
								<img src="{{ asset('storage'.'/'.$foto->foto) }}" class="d-block w-100" style="height:400px;" alt="...">

							</div>
							@endforeach
							@endif


							<!-- Agregar más validaciones para las otras fotos -->
						</div>
						<a class="carousel-control-prev" href="#carouselExampleIndicators-2" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carouselExampleIndicators-2" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
				</div>


				<div class="col-md-6">
					<h2>Descripción Del Hotel</h2>
					<p class="">{{ $paquete->hotel->descripcion }}</p>
				</div>
			</div>
		</div>
	</div>

	@endif


	@if(isset($paquete->hotel->videoHotel))

	<!--VIDEOS HOTEL-->
	<div class="container mt-5 mb-3 text-center">

		<div class="col-md-12">
			@if (count($paquete->hotel->videoHotel) > 0)
			
			<div class="pt-5 text-center">
				<h2>Video Del Hotel</h2>
			</div>

			<div id="carouselExampleIndicators-{{ $paquete->hotel->id }}2" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">

					@if (count($paquete->hotel->videoHotel) > 0)
					@php
					for ($i=0; $i < count($paquete->hotel->videoHotel); $i++) { 
						# code...
						echo '<li data-target="#carouselExampleIndicators-{{ $hotel->id }}" data-slide-to="1"></li>';
					}

					@endphp


					@endif
					<!-- Agregar más validaciones para las otras fotos -->
				</ol>
				<div class="carousel-inner">
					@if (count($paquete->hotel->videoHotel) > 0)
					@php
					if(!isset($active)){
						$active = 0;
					}
					@endphp
					@foreach ($paquete->hotel->videoHotel as $video)											
					<div class="carousel-item @if($active == 0) active @endif">
						<video  controls muted class="w-100 my-4">
							<source  src="{{asset('storage'.'/'.$video->video)}}" type="video/mp4" width="100%" height="100%">
							</video>
						</div>


						@php

						$active = 1;

						@endphp
						@endforeach
						@endif


						<!-- Agregar más validaciones para las otras fotos -->
					</div>
					
					<a class="carousel-control-prev" href="#carouselExampleIndicators-{{ $paquete->hotel->id }}2" style="background-color:transparent; height:50px ; width: 50px; margin-top: 35%;border-radius: 100%; margin-left: 10px " role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleIndicators-{{ $paquete->hotel->id }}2"style="background-color:transparent; height:50px ; width: 50px; margin-top: 35%;border-radius: 100%; margin-right: 10px; " role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
				@endif

			</div>
		</div>

		@endif


		@include('layouts.footer.footer-home')

	</body>
	@endsection