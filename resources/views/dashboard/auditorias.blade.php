@extends('sources-dashboard')

@section('head-title')

<title>VIAJETUR | AUDITORIAS</title>

@endsection

@section('content')
<!--TITLE BODY-->
<div class="wrapper">
	<div class="content-wrapper">
		<div class="container">
			<div class="content-header mb-4">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h4 class="m-0"><i class="fas fa-balance-scale"></i> REGISTRO DE AUDITORIAS</h4>
						</div>
                      <div class="col-sm-6">
                        <div class="float-sm-right">
                          <a href="{{url('/dashboard')}}" class="btn btn-dark">REGRESAR</a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="container-fluid">
        <form action="{{ url('auditorias/')}}" class="row" method="post">
            <div class="form-group col-4">
                <label for="">fecha de inicial</label>
                <div class="input-group ">
                    <div class="input-group-append">
                        <span class="input-group-text bg-purple" ><i class="fas fa-calendar-alt"></i></span>
                    </div>
                    <input class="form-control" type="date" name="fecha_inicio" placeholder="Recipient's text" aria-label="Recipient's " aria-describedby="my-addon">
                </div>
            </div>
            <div class="form-group col-4">
                <label for="">fecha final</label>
                <div class="input-group ">
                    <div class="input-group-append">
                        <span class="input-group-text bg-purple" ><i class="fas fa-calendar-alt"></i></span>
                    </div>
                    <input class="form-control" type="date" name=" fecha_fin" placeholder="Recipient's text" aria-label="Recipient's " aria-describedby="my-addon">
                </div>
            </div>
            @method('PATCH')
            @csrf
            <div class="form-group">
                
                <div class="input-group " style="margin-top: 32px;">
                    <button class="btn btn-success " type="submit">Filtrar por fecha</button>
                </div>
            </div>
        </form>
      </div>
      <!--SEARCH-->
      <div class="container mb-1">
        <div class="row">
            <div class="col-md-8">
                <div class="input-group mb-3 align-items-center">
                    <input type="text" id="searchInput" class="form-control" placeholder="Ingrese su búsqueda" aria-label="Búsqueda" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="fas fa-search py-1"></i> <!-- Icono de búsqueda de Font Awesome -->
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="d-flex align-items-center justify-content-center">
                    <label for="selectPaginado">Filas por página:</label>
                    <select id="selectPaginado" class="form-control w-50 ml-1">
                        <option value="100">100</option>
                        <option value="50">50</option>
                        <option value="20">20</option>
                        <option value="10">10</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!--TABLE-->
    <div class="container-fluid">
        <table class="table table-light table-hover text-center table-responsive">
            <thead class="bg-purple text-dark">
                <tr>

                    <th class="col-md-1">Correo del usuario</th>
                    <th class="col-md-1">Descripción</th>
                    <th class="col-md-1">Fecha</th>
                </tr>
            </thead>
            <tbody>

                @forelse ($auditorias as $auditoria)
                <tr>
                    <td>{{$auditoria->user->email}}</td>
                    <td>{{$auditoria->descripcion}}</td>
                    <td>{{$auditoria->created_at}}</td>         
                </tr>
                @empty
                <td colspan="4"><h4>No se encontraron resultados</h4></td>
                @endforelse
                <tr id="noResultRow" style="display: none;">
                    <td colspan="4"><h4>No se encontraron resultados</h4></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>

@section('extra-scripts')

<!--Barra de busqueda-->
<script>
    $(document).ready(function() {
  // Función para actualizar el paginado y el filtro de búsqueda
      function actualizarTabla(cantidadFilas) {
    var value = $("#searchInput").val().toLowerCase().trim(); // Obtener el valor del campo de búsqueda
    $("table tbody tr").hide(); // Ocultar todas las filas
    
    // Filtrar las filas por el valor de búsqueda y mostrar solo las necesarias según el paginado
    $("table tbody tr").filter(function() {
      return $(this).text().toLowerCase().replace(/\s+/g, ' ').indexOf(value) > -1;
    }).slice(0, cantidadFilas).show(); // Mostrar las primeras "cantidadFilas" filas que coinciden con la búsqueda

    if ($("table tbody tr:visible").length === 0) {
      $("#noResultRow").show();
  } else {
      $("#noResultRow").hide();
  }
}

  // Manejar el cambio del select para el paginado
$('#selectPaginado').change(function() {
    var cantidadFilas = $(this).val();
    actualizarTabla(cantidadFilas);
});

  // Manejar el cambio en la barra de búsqueda
$("#searchInput").on("input", function() {
    var cantidadFilas = $('#selectPaginado').val(); // Obtener la cantidad actual de filas por página
    actualizarTabla(cantidadFilas);
});


    // Llamar a actualizarTabla al cargar la página
    var cantidadFilasDefault = $('#selectPaginado').val(); // Obtener la cantidad por defecto
    actualizarTabla(cantidadFilasDefault); // Aplicar el paginado al cargar la página
});
</script>

@endsection

@endsection