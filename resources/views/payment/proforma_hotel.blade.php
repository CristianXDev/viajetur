@extends('sources-dashboard')

@section('head-title')

<title>VIAJETUR | DATOS DEl HOTEL</title>

@endsection

@section('content')

<style>
	.truncate-text {
		max-width: 150px; /* Establece el ancho máximo para la celda */
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis; /* Muestra puntos suspensivos al final del texto truncado */
	}
</style>

<!--TITLE BODY-->
<div class="wrapper">
	<div class="content-wrapper">
		<form action="{{ route('pay_hotel') }}" method="POST" class="container">
			<div class="content-header mb-4">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h4 class="m-0"> <i class="fas fa-dollar-sign"></i> GASTOS DEL HOTEL</h4>
						</div>
						<div class="col-sm-6">
							<div class="float-sm-right">
								<a href="{{ route('dashboard-hotel-show',[Str::slug($hotel->nombre),$hotel->id]) }}" class="btn btn-dark">¡REGRESAR!</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-10 mx-auto mb-5 contenedor" id="contenedor1" style="display: block;">	
				<div class="container p-5 bg-white rounded">
					<div class="row">
						<div class="col-md-6">
							<h3>Información del cliente</h3>
							<p>Nombre:  {{Auth()->user()->nombre}}</p>
							<p>Apellido: {{Auth()->user()->apellido}}</p>
							<p>Cedula: {{Auth()->user()->cedula}}</p>
							<p>Teléfono: {{ Auth()->user()->telefono ? Auth()->user()->telefono : 'No posee' }}</p>
						</div>
						<div class="col-md-6 text-right">
							@php

							$fecha = date('d-m-Y');

							@endphp
							<p>Fecha: {{ $fecha }}</p>
						</div>
					</div>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Concepto</th>
								<th>Detalle</th>
								<th>Precio</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Hotel</td>
								<td class="truncate-text"> {{isset($hotel->descripcion) && !empty($hotel->descripcion) ? $hotel->descripcion : 'No tiene'}}
								</td>
								<td>${{$hotel->precio}}</td>
							</tr>
							<tr>
								<td>Personas</td>
								<td colspan="2"><input type="number" value="1" min="1" max="5" name="personas"></td>
							</tr>
							<tr>
								<td colspan="3"><strong>Total: </strong>${{$hotel->precio}}</td>
							</tr>
						</tbody>
					</table>
					<div class="text-center">
						<input type="button"  id="btnSiguiente" class="btn btn-primary" value="SIGUIENTE">
					</div>
				</div>
			</div>

			<div class="container contenedor" id="contenedor2" style="display: none;">
				<div class="row mx-2">
					<div class="col-md-6">
						<div class="card">
							<div class="card-header">
								<img src="{{ asset('static/images/paypal.png') }}" alt="..." class="card-img-top">
							</div>
							<div class="card-body text-center">

								<input type="hidden" name="id" value="{{ $hotel->id }}">

								<button type="submit" class="btn btn-primary">Realizar Pago</button>

								@csrf
							</div>
						</div>
					</div>
				</div>

				<div class="text-center my-5">
					<input type="button" id="btnRegresar" class="btn btn-secondary" value="REGRESAR">
				</div>
			</form>
		</div>
	</div>

	@section('extra-scripts')
	<script>
		$(document).ready(function() {
			$("#btnSiguiente").click(function() {
				$("#contenedor1").css("display", "none");
				$("#contenedor2").css("display", "block");
			});

			$("#btnRegresar").click(function() {
				$("#contenedor2").css("display", "none");
				$("#contenedor1").css("display", "block");
			});
		});
	</script>
	@endsection

	@endsection