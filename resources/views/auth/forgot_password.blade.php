<!--le dice al sistema de en que pagina se mostrar este contenido-->
@extends('sources-login')

@section('head-title')

<title>VIAJETUR | RECUPERACIÓN DE CONTRASEÑA</title>

@endsection

@section('nav-btn')

<a href="{{ route('register') }}" class="button-primary bold ml-4">¡Registrate!</a>

@endsection

@section('content')

	<!--FORM-->
	<form action="{{ route('forgotPass') }}" method="POST" class="form forgot" data-aos="fade-left" data-aos-once="true">

		@csrf
		@include('layouts.partials.alert')

		<!--HEAD FORM-->
		<div class="head-form">

			<img src="{{ asset('static/images/favicon.png') }}" alt="logo">
			<h1>VIAJE<span>TUR</span></h1>

		</div>

		<!--BODY FORM-->
		<div class="body-form">

			<label>Correo Electronico</label>
			<div class="item-body-form">
				<i class="fas fa-envelope"></i><input type="email" name="email" placeholder="Correo Electronico..." required>
			</div>
			

		</div>

		<!--FOOTER FORM-->
		<div class="footer-form">

			<input type="submit" value="¡Enviar correo!">

			<span>¿No tiene problemas con su cuenta?<a href="{{ route('login') }}"> ¡Inicia sesión!</a></span>

		</div>

	</form>
@endsection