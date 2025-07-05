<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<style>

		body{
			font-family:'Arial,sans-serif;';

			background:#F2F1F1;

			display:flex;
			flex-direction:column;
			align-items:center;
			justify-content:center;
		}

		.card{
			width:300px;
			height:auto;

			position:absolute;

			background:#FFF;

			display:flex;
			flex-direction:column;
			align-items:center;
			justify-content:center;

			top:20%;
			padding:5em;

			border-radius:8px;

			box-shadow:0 4px 16px rgb(0 0 0 / 20%);
		}

		.card-header > *{
			width:150px;
			height:auto;

			margin-top:-150px;

			border-radius:100%;

			z-index:-2;

			border:20px solid #FFF;
		}

		.card-body{
			top:-100px;

			display:flex;
			flex-direction:column;
			align-items:center;
			justify-content:center;
		}


		.code{
			width:290px;
			height:50px;

			border:1px solid #5F4DEE;

			outline:0;

			font-weight:bold;
			font-size:30px;
		}

		.btn{
			padding:1em;

			background:#5F4DEE;
			color:#FFF;
			border:1px solid #5F4DEE;

			border-radius:4px;

			text-decoration:none;

			transition:all 500ms ease;
		}

		.btn:hover{
			background:#FFF;
			color:#5F4DEE;
		}

	</style>

</head>
<body>

	<div class="card">
		<div class="card-header">

			<img src="{{ asset('static/images/favicon.png') }}">

		</div>

		<div class="card-body">

			<h2>¡Bienvenido {{ $datos['nombre'] }}!</h2>
			<p>Hemos registrado su usuario en el sistema, para poder acceder a ella debe precionar el botón de abajo para que podamos confirmar su correo electronico.</p>

			<a href='{{ url("/confirmed_email/?token=".$datos["token"]) }}' class="btn">¡Confirmar correo electronico!</a>

			<p><small>Una vez precionado el botón será redirecionado automaticamente para que pueda acceder a su cuenta.</small></p>

		</div>
	</div>


</body>
</html>