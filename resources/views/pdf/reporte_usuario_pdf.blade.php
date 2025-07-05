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

	</style>
</head>

<!--HEADER-->
<center>

	<hr>

	<header class="p-1 flex-center">
		<div class="flex-center">
			<h1>VIAJE<span class="text-blue">TUR</span></h>
			</div>
		</header>
	</center>

	<h3 style="text-align:center;">REPORTE DE USUARIOS - {{ $fecha }}</h3>

	<hr>

	<!--TABLE-->
	<div class="p-1">
		<table class="table table-bordered" style="clear:both; text-align:center;">
			<thead>
				<tr>
					<th>Rol</th>
					<th>Nombre</th>
					<th>Apellido</th>
					<th>Estatus</th>
					<th>Fecha de ingreso al sistema</th>
					<th>Estado</th>
					<th>Municipio</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($usuariosFiltrados as $usuariosFiltrado)
				<tr>
					<td class="col-md-2"><p>

						@switch($usuariosFiltrado->id_role)

							@case('1')
								Administrador
							@break

							@case('2')
								Asistente
							@break

							@case('3')
								Cliente
							@break

							@case('4')
								Proveedor
							@break

						@endswitch

					</p></td>
					<td class="col-md-2"><p>{{$usuariosFiltrado->nombre}}</p></td>
					<td class="col-md-2"><p>{{$usuariosFiltrado->apellido}}</p></td>
					<td class="col-md-2"><p>

						@switch($usuariosFiltrado->status)

							@case('1')
								Activo
							@break

							@case('2')
								Inactivo
							@break

							@case('3')
								Suspendido
							@break

						@endswitch
					</p></td>
					<td class="col-md-2"><p>{{$usuariosFiltrado->created_at}}</p></td>
					<td class="col-md-2"><p>{{$usuariosFiltrado->municipio->estado->nombre}}</p></td>
					<td class="col-md-2"><p>{{$usuariosFiltrado->municipio->nombre}}</p></td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>




</body>
</html>