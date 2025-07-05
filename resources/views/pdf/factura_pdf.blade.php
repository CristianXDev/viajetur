<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PDF - FACTURA</title>

	<!--Google Fonts -->
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,400&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap" rel="stylesheet">

	<style>

		body{
			margin:0;
			padding:0;

			font-family:'Open Sans',sans-serif;
		}

		header{
			display:flex;
			flex-direction:row;
			align-items:center;
			justify-content:space-between;
		}

		.text-blue{
			color:#5F4DEE;
		}

		.flex-center{
			display:flex;
			align-items:center;
			justify-content:center;
		}

		.flex-column{
			display:flex;
			flex-direction:column;
			align-items:center;
			justify-content:center;
		}

		.float-left{
			float:left;
		}

		.float-right{
			float:right;
		}

		.p-1{
			padding:1rem;
		}

		.mx-1{
			margin:0 1rem 0 1rem;
		}

		.w-100{
			width:100%;
		}

		table {
			width: 100%;
			border-collapse: collapse;
			border:1px solid #5F4DEE;
		}

		th{
			color:#FFF;
		}

		td{
			border:1px solid #5F4DEE;
		}

		th, td {
			padding: 10px;
			text-align: left;
		}

		thead {
			background-color: #5F4DEE;
		}

		tfoot {
			font-weight: bold;
		}

		tfoot td {
			border-top: 2px solid #5F4DEE;
		}

		.truncate-text {
			max-width: 150px; /* Establece el ancho máximo para la celda */
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis; /* Muestra puntos suspensivos al final del texto truncado */

		</style>
	</head>

	<!--HEADER-->
	<center>
		<header class="p-1 flex-center">
			<div class="flex-center">
				<h2>VIAJE<span class="text-blue">TUR</span></h2>
			</div>
		</header>
	</center>

	<!--FACTURACIÓN-->
	<div class="w-100">
		<div class="float-left flex-colum p-1">
			<h2>[FACTURA]</h2>
			<h5>Pedido: {{ strtoupper($proforma->paquete->nombre) }}</h5>
			<h5>Destino: {{ $proforma->paquete->destino->nombre }}</h5>
			<h5>Cantidad de personas: {{ $proforma->personas }}</h5>
			<h5>Fecha de reserva: {{ $proforma->fecha_reserva }}</h5>
		</div>

		<div class="float-right flex-colum p-1">
			<h3>Referencia:#{{ $proforma->referencia }}</h3>
		</div>
	</div>

	<hr>

	<div class="w-100" style="clear:both;">
		<div class="float-left flex-colum p-1">
			<h2>[USUARIO]</h2>
			<h5>Nombre: {{Auth()->user()->nombre}}</h5>
			<h5>Apellido: {{Auth()->user()->apellido}}</h5>
			<h5>CI: {{Auth()->user()->cedula}}</h5>
			<h5>Teléfono: {{ Auth()->user()->telefono ? Auth()->user()->telefono : 'No posee' }}</h5>
		</div>
	</div>

	<div class="w-100 float-right" style="clear:both;">
		<div class="float-right flex-colum p-1">
			<h2>[PROCESADOR DE PAGO]</h2>
			<h5>Metodo de pago: {{ $proforma->metodo_pago }}</h5>
			<h5>Estatus:

				@switch($proforma->estatus)

				@case (1)

				<span class="text-success">Pagado</span>

				@break

				@case (2)

				<span class="text-warning">Pendiente</span>

				@break

				@case (3)

				<span class="text-danger">Rechazado</span>

				@break

			@endswitch</h5>
			<h5>Fecha de pago:{{ $proforma->fecha_pago }}</h5>
		</div>
	</div>

	<!--TABLE-->
	<div class="p-1">
		<table class="table table-bordered" style="clear:both;">
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
					<td class="truncate-text">{{ $proforma->paquete->descripcion }}</td>
					<td>${{ $proforma->paquete->precio }}</td>
				</tr>
				<tr>
					<td>Hotel</td>
					<td class="truncate-text">
						{{isset($proforma->paquete->hotel->descripcion) && !empty($proforma->paquete->hotel->descripcion) ? $proforma->paquete->hotel->descripcion : 'No tiene'}}
					</td>
				</tr>
				<tr>
					<td>Personas</td>
					<td colspan="2">{{ $proforma->personas }}</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="2" class="text-right">Total:</td>
					<td>${{ $proforma->paquete->precio }}</td>
				</tr>
			</tfoot>
		</table>
	</div>




</body>
</html>