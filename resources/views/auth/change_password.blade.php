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
	<form action="{{ url('/validateChangePassword?token='.request()->query('token')
) }}" method="POST" class="form change" data-aos="fade-left" data-aos-once="true">

		@csrf
		@include('layouts.partials.alert')

		<!--HEAD FORM-->
		<div class="head-form">

			<img src="{{ asset('static/images/favicon.png') }}" alt="logo">
			<h1>VIAJE<span>TUR</span></h1>

		</div>

		<!--BODY FORM-->
		<div class="body-form">
			
			<label>Nueva contraseña</label>
			<div class="item-body-form">
				<i class="fas fa-key"></i><input type="password" name="password" placeholder="Contraseña..." required>
			</div>

			<label>Repetir contraseña</label>
			<div class="item-body-form">
				<i class="fas fa-lock"></i><input type="password" name="password_confirmation" placeholder="Repetir contraseña..." required>
			</div>

		</div>

		<!--FOOTER FORM-->
		<div class="footer-form">

			<input type="submit" value="¡Actualizar contraseña!">

			<span>¿No tiene problemas con su cuenta? <a href="login.html">¡Inicia sesión!</a></span>

		</div>

	</form>
@endsection