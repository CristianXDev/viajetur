@extends('sources-dashboard')

@section('head-title')

<title>VIAJETUR | FACTURA DEL PAQUETE</title>

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
		<div class="container">
			<div class="content-header mb-4">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h4 class="m-0">DATOS DE LA COMPRA <i class="fas fa-dollar-sign text-success"></i></h4>
						</div>
						<div class="col-sm-6">
							<div class="float-sm-right">
								<a href="{{ route('mis_reservas') }}" class="btn btn-dark mx-1">REGRESAR</a>
							</div>

							<div class="float-sm-right">
								<a href="{{ route('factura_pdf',[$proforma->id]) }}" class="btn btn-success">DESCARGAR EN PDF</a>
							</div>

						</div>
					</div>
				</div>
			</div>

			<div class="col-md-10 mx-auto">	
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
							<h4>Factura: #{{ $proforma->referencia }}</h4>
							<p>Fecha: {{ $proforma->fecha_pago }}</p>
						</div>
					</div>
					<div class="col-md-12 text-left">
						<hr>
						<h3>Información del paquete</h3>
						<p>Nombre: {{$proforma->paquete->nombre}}</p>
						<p>Destino: {{$proforma->paquete->destino->nombre}}</p>
						<p>Días: {{$proforma->paquete->dias}}</p>
						<p>Noches: {{$proforma->paquete->noches}}</p>
						<p>Capacidad de personas: {{$proforma->paquete->capacidad}}</p>
						<hr>
					</div>
					<div class="col-md-12 mb-4 text-left">
						<h3>Detalles del pago</h3>
						<p>Procesador de pago: {{ $proforma->metodo_pago }}</p>
						<p>Estatus del pago: <span class="text-green">Pagado</span></p>
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
								<td>Paquete Turístico</td>
								<td class="truncate-text">{{$proforma->paquete->descripcion}}</td>
								<td>${{$proforma->paquete->precio}}</td>
							</tr>
							<tr>
								<td>Hotel</td>
								<td class="truncate-text">{{isset($proforma->paquete->hotel->descripcion) && !empty($proforma->paquete->hotel->descripcion) ? $proforma->paquete->hotel->descripcion : 'No tiene'}}
								</td>
								<td>$0</td>
							</tr>
							<tr>
								<td>Personas</td>
								<td colspan="2">{{$proforma->personas}}</td>
							</tr>
							<tr>
								<td colspan="2"><strong>Total: </strong></td>
								<td>${{$proforma->paquete->precio}}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			@endsection