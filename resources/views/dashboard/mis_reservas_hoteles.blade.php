@extends('sources-dashboard')

@section('head-title')

<title>VIAJETUR | MIS HOTELES RESERVADOS</title>

@endsection

@section('content')

<div class="wrapper">
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="m-0"><i class="fas fa-hotel"></i> MIS HOTELES RESERVADOS</h4>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-sm-right">
                            <a href="{{url('/dashboard')}}" class="btn btn-dark">REGRESAR</a>
                        </div>
                    </div>
                </div>
            </div>
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
        <div class="container">
            <div class="table-responsive">
                <table class="table table-light table-hover text-center">
                    <thead class="bg-purple text-dark">
                        <tr>
                            <th class="col-md-3">Nombre del hotel</th>
                            <th class="col-md-3">Fecha del pago</th>
                            <th class="col-md-2">Estatus</th>
                            <th class="col-md-2">Pagado</th>
                            <th class="col-md-2">Factura</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($proformas) && count($proformas) > 0)
                        @foreach ($proformas as $proforma)
                        <tr>
                            <th class="col-md-3">{{ strtoupper($proforma->hotel->nombre) }}</th>
                            <th class="col-md-3">{{$proforma->fecha_pago}}</th>
                            <th class="col-md-2">
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

                                @endswitch
                            </th>
                            <th class="col-md-2">{{$proforma->hotel->precio}}$</th>
                            <th class="col-md-2">
                                <a href="{{ route('factura_hotel',[$proforma->id]) }}"><i class="btn btn-primary fas fa-eye"></i></a>
                                <a href="{{ route('factura_pdf_hotel',[$proforma->id]) }}"><i class="btn btn-danger fas fa-file-pdf"></i></a>
                            </th>
                        </tr>
                        @endforeach 
                        @else
                        <tr>
                            <td class="col-md-3">No existen datos disponibles</td>
                            <td class="col-md-3">No existen datos disponibles</td>
                            <td class="col-md-2">No existen datos disponibles</td>
                            <td class="col-md-2">No existen datos disponibles</td>
                            <td class="col-md-2">No existen datos disponibles</td>
                        </tr>
                        @endif
                        <tr id="noResultRow" style="display: none;">
                            <td colspan="12"><h4>No se encontraron resultados</h4></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@section('extra-scripts')

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