@extends('sources-dashboard')

@section('head-title')

<title>VIAJETUR | ESTADOS</title>

@endsection

@section('content')

<div class="wrapper">
    <div class="content-wrapper">
        <div class="container">
            <div class="content-header mb-4">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h4 class="m-0"><i class="fas fa-map-marker-alt"></i> ESTADOS DISPONIBLES</h4>
                        </div>
                        @if (Auth()->user()->role->id != 4 && Auth()->user()->role->administrar_estados == 1 && Auth()->user()->role->agregar == 1)
                        <div class="col-sm-6">
                            <div class="float-sm-right">
                                <a href="{{url('estado/create')}}" class="btn btn-success">AGREGAR</a>
                            </div>
                        </div>
                        @endif
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
           <div class="container-fluid">
            <table class="table table-light table-hover text-center">
                <thead class="bg-purple text-dark">
                    <tr>
                        <th class="col-md-6">Nombre</th>
                        @if (Auth()->user()->role->id != 4 && (Auth()->user()->role->editar == 1 || Auth()->user()->role->borrar == 1) )    
                        <th class="col-md-6">Acciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @if ( isset($estados) && count($estados) > 0)
                    @foreach ($estados as $estado)
                    <tr>

                        <td class=""><p>{{$estado->nombre}}</p></td>
                        @if (Auth()->user()->role->id != 4 && (Auth()->user()->role->editar == 1 || Auth()->user()->role->borrar == 1) )    
                        <td class="">
                            <form class="container-fluid" action="{{url('estado/'.$estado->id.'/')}}" method="post">
                                @if (Auth()->user()->role->id != 4 && Auth()->user()->role->administrar_estados == 1 && Auth()->user()->role->editar == 1)
                                <a href="{{url('/estado/'.$estado->id.'/edit')}}" class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>    
                                @endif
                                @if (Auth()->user()->role->id != 4 && Auth()->user()->role->administrar_estados == 1 && Auth()->user()->role->borrar == 1)    
                                @csrf
                                {{method_field('DELETE')}}
                                <button type="submit"  class="btn btn-danger" onclick="return confirm('¿Quieres borrar {{$estado->nombre}} de la lista de estado?')" value="{{$estado->id}}"><i class="fas fa-trash"></i></button>
                                @endif

                            </form>
                            
                        </td>
                        @endif
                    </tr>
                    @endforeach  
                    @else
                    <tr>
                        <td class="">No existen datos disponibles</td>
                        <td class="">No existe aciones disponibles</td>
                    </tr>
                    @endif
                    <tr id="noResultRow" style="display: none;">
                        <td colspan="4"><h4>No se encontraron resultados</h4></td>
                    </tr>
                </tbody>
            </table>
        </div>

                <!--PAGINATE
                <div class="container-fluid pb-4">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item"><a class="page-link" href="#">Anterior</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
                        </ul>
                    </nav>
                </div>
    
            -->
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