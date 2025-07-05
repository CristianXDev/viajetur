@extends('sources-dashboard')

@section('head-title')

<title>VIAJETUR | ROLES</title>

@endsection

@section('content')

<div class="wrapper">
    <div class="content-wrapper">
        <div class="container">
            <div class="content-header mb-4">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h4 class="m-0"><i class="fas fa-map-marker-alt"></i> ROLES DISPONIBLES</h4>
                        </div>
                        @if (Auth()->user()->role->id != 4 && Auth()->user()->role->administrar_roles == 1 && Auth()->user()->role->agregar == 1)
                        <div class="col-sm-6">
                            <div class="float-sm-right">
                                <a href="{{url('role/create')}}" class="btn btn-success">AGREGAR</a>
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
            <table id="tablaDatos" class="table table-light table-hover text-center">
                <thead class="bg-purple text-dark">
                    <tr>
                        <th class="">Nombre</th>
                        <th class="">Permisos</th>
                        @if (Auth()->user()->role->id != 4 && (Auth()->user()->role->editar == 1 || Auth()->user()->role->borrar == 1) )    
                        <th class="">Acciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @if ( isset($roles) && count($roles) > 0)
                    @foreach ($roles as $role)
                    <tr>
                        <td class="col-md-3 align-middle"><p><strong>{{$role->nombre}}</strong></p></td>
                        <td class="col-md-6"><p><ul style="list-style: none;">
                            <li>Agregar:@if($role->agregar == 1) <span class="text-success fas fa-check"></span> @else <span class="text-danger fas fa-times"></span> @endif </li> 
                            <li>Editar:@if($role->editar == 1)   <span class="text-success fas fa-check"></span> @else <span class="text-danger fas fa-times"></span> @endif</li> 
                            <li>Borrar:@if($role->borrar == 1)   <span class="text-success fas fa-check"></span> @else <span class="text-danger fas fa-times"></span> @endif</li> 
                            <li>Bloquear:@if($role->bloquear == 1)   <span class="text-success fas fa-check"></span> @else <span class="text-danger fas fa-times"></span> @endif</li> 
                            <li>Administrar usuarios:@if($role->administrar_usuarios == 1)   <span class="text-success fas fa-check"></span> @else <span class="text-danger fas fa-times"></span> @endif</li> 
                            <li>Administrar pagos:@if($role->administrar_pagos == 1)   <span class="text-success fas fa-check"></span> @else <span class="text-danger fas fa-times"></span> @endif</li> 
                            <li>Administrar roles:@if($role->administrar_roles == 1)   <span class="text-success fas fa-check"></span> @else <span class="text-danger fas fa-times"></span> @endif</li> 
                            <li>Administrar estados:@if($role->administrar_estados == 1)   <span class="text-success fas fa-check"></span> @else <span class="text-danger fas fa-times"></span> @endif</li> 
                            <li>Administrar destinos:@if($role->administrar_destinos == 1)   <span class="text-success fas fa-check"></span> @else <span class="text-danger fas fa-times"></span> @endif</li> 
                            <li>Administrar municipios:@if($role->administrar_municipios == 1)   <span class="text-success fas fa-check"></span> @else <span class="text-danger fas fa-times"></span> @endif</li> 
                        </ul></p></td>
                        @if (Auth()->user()->role->id != 4 && (Auth()->user()->role->editar == 1 || Auth()->user()->role->borrar == 1) )    
                        <td class="col-md-3 align-middle">
                            <form class="container-fluid" action="{{url('role/'.$role->id.'/')}}" method="post">
                                @if (Auth()->user()->role->id != 4 && Auth()->user()->role->administrar_roles == 1 && Auth()->user()->role->editar == 1)
                                <a href="{{url('/role/'.$role->id.'/edit')}}" class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>    
                                @endif
                                @if (Auth()->user()->role->id != 4 && Auth()->user()->role->administrar_roles == 1 && Auth()->user()->role->borrar == 1)    
                                @csrf
                                {{method_field('DELETE')}}
                                <button type="submit"  class="btn btn-danger" onclick="return confirm('¿Quieres borrar {{$role->nombre}} de la lista de role?')" value="{{$role->id}}"><i class="fas fa-trash"></i></button>
                                @endif

                            </form>

                        </td>
                        @endif
                    </tr>
                    @endforeach  
                    @else
                    <tr>
                        <td class="">No existen datos disponibles</td>
                        <td class="">No existen datos disponibles</td>
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