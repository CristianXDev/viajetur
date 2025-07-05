<!--le dice al sistema de en que pagina se mostrar este contenido-->
@extends('sources-login')

@section('head-title')

<title>VIAJETUR | LOGIN</title>

@endsection

@section('nav-btn')

<a href="{{ route('register') }}" class="button-primary bold ml-4">¡Registrate!</a>

@endsection

@section('content')

@include('layouts.partials.alert')

<form action="login" method="POST" class="form login" data-aos="fade-left" data-aos-once="true" id="myForm">

	@csrf

	<!--HEAD FORM-->
	<div class="head-form">

		<img src="{{ asset('static/images/favicon.png') }}" alt="logo">
		<h1>VIAJE<span>TUR</span></h1>

	</div>

	<!--BODY FORM-->
	<div class="body-form">

		<label>Correo electronico</label>
		<div class="item-body-form">
			<i class="fas fa-envelope" data-toggle="modal" data-target="#emailModal"></i><input type="text" name="usuario" placeholder="Correo...">
			<div class="invalid-feedback">Por favor ingresa un email válido.</div>
		</div>

		<label>Contraseña</label>
		<div class="item-body-form">
			<i class="fas fa-key" data-toggle="modal" data-target="#passwordModal"></i><input type="password" name="password" id="email" placeholder="Contraseña...">
			<div class="invalid-feedback">Por favor ingresa una contraseña.</div>
		</div>
	</div>

	<!--FOOTER FORM-->
	<div class="footer-form">

		<input type="submit" value="¡INGRESAR!">

		<span>¿Olvido su contraseña?<a href="{{ route('forgot') }}"> ¡Restaurar ahora!</a></span>

	</div>
</form>

<!--MODAL-->
<div class="modal" id="emailModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><i class="fas fa-envelope"></i> Requerimientos del campo de correo</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">

				<h5>[Consideraciones]</h5>
				<ul>
					<li>Colocar el símbolo "@" seguido del dominio (ejemplo: correo@gmail.com).</li>
					<li>Verificar que no haya espacios adicionales antes, después o dentro del correo electrónico.</li>
					<li>Utilizar caracteres permitidos como letras, números, puntos, guiones y guiones bajos.</li>
					<li>Evitar el uso de caracteres especiales o emoticones en el correo electrónico.</li>
					<li>Revisar la ortografía y la sintaxis del correo electrónico antes de confirmarlo.</li>
					<li>Asegurarse de que el dominio del correo electrónico sea válido y esté escrito correctamente.</li>
					<li>Utilizar un proveedor de correo electrónico confiable y seguro para evitar problemas de seguridad.</li>
				</ul>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

<div class="modal" id="passwordModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><i class="fas fa-key"></i> Requerimientos del campo de contraseña</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">

				<h5>[Consideraciones]</h5>
				<ul>
					<li>La contraseña debe ser requerida, es decir, no puede estar vacía.</li>
					<li>Debe tener al menos 8 caracteres de longitud para garantizar su seguridad.</li>
					<li>Utilizar al menos una letra mayúscula, un número y un carácter especial como !@#$%^&*,.?":<> para aumentar su complejidad.</li>
					<li>Evitar el uso de información personal como nombres, fechas de nacimiento o palabras comunes.</li>
					<li>No utilizar patrones predecibles como "12345678" o "password".</li>
					<li>Considerar el uso de una frase o combinación de palabras que sea fácil de recordar pero difícil de adivinar para otros.</li>
					<li>Actualizar la contraseña periódicamente para mantener la seguridad de la cuenta.</li>
				</ul>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
@endsection