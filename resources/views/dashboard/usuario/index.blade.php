@extends('sources-dashboard')

@section('head-title')

<title>VIAJETUR | ADMINISTRAR USUARIOS</title>

@endsection

@section('content')

<div class="wrapper">
    <div class="content-wrapper">
        <div class="container">
            <div class="content-header mb-4">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                           <h4 class="m-0"><i class="fas fa-users"></i> ADMINISTRACIÓN DE USUARIOS</h4>
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
        <div class="container-fluid">
            <table class="table table-light table-hover text-center">
                <thead class="bg-purple text-dark">
                    <tr>
                        <th class="col-md-2">Nombre</th>
                        <th class="col-md-2">Apellido</th>
                        <th class="col-md-2">Correo</thcol-md-2>
                        <th class="col-md-2">Role</th>
                        <th class="col-md-2">Estado</th>
                        @if (Auth()->user()->role->administrar_usuarios == 1 && (Auth()->user()->role->editar == 1 || Auth()->user()->role->bloquear == 1))    
                        <th class="col-md-2">Acciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @if ( isset($users) && count($users) > 0)
                    @foreach ($users as $user)
                    <tr>

                        <td class="col-md-2"><p>{{$user->nombre}}</p>
                            @if (Auth()->user()->role->administrar_usuarios == 1 && (Auth()->user()->role->editar == 1 || Auth()->user()->role->bloquear == 1))   
                            @if (isset($user->proveedor) && $user->proveedor->solicitud == 1)
                            <button @if(Auth()->user()->id == $user->id) class="btn btn-info disabled" @else class="btn btn-info"  data-target="#solicitud{{$user->id}}" @endif type="button" data-toggle="modal" style="border-radius:100%; position: absolute;top:1px; right:1px;"><i class="fas fa-lightbulb"></i></button>
                            <div id="solicitud{{$user->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <form action="{{url('/usuario/solicitud')}}" method="post">
                                        @csrf  
                                        <div class="modal-content">
                                            <div class="modal-header bg-purple text center">
                                                <h5 class="modal-title"><i class="fas fa-id-card-alt text-white"></i>Cambiar rol de usuario</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p> el usuario solicito el permiso para ser proveedor con el documento de identidad {{$user->proveedor->rif}}</p>
                                                <input type="hidden" class="hidem" name="id_user" value="{{$user->id}}">
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="submit" class="btn btn-outline-success" value="1" name="solicitud">aceptar</button>
                                                <button type="submit" class="btn btn-outline-danger" >rechazar</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                            </div>
                            @endif
                            @endif
                        </td>
                        <td class="col-md-2"><p>{{$user->apellido}}</p></td>
                        <td class="col-md-2"><p>{{$user->email}}</p></td>
                        <td class="col-md-2"><p>{{$user->role->nombre}}</p></td>
                        <td class="col-md-2"><p>@if($user->status == 1) <span class="text-success">Activo</span>@else <span class="text-danger">bloqueado</span> @endif</p></td>
                        @if (Auth()->user()->role->administrar_usuarios == 1 && (Auth()->user()->role->editar == 1 || Auth()->user()->role->bloquear == 1 ) )    
                        <td class="col-md-2">
                            <div class="container-fluid d-flex">


                                @if (Auth()->user()->role->administrar_usuarios == 1 && Auth()->user()->role->editar == 1)    

                                <button @if(Auth()->user()->id == $user->id) class="btn btn-info disabled" @else class="btn btn-info"  data-target="#my-modal{{$user->id}}" @endif style="margin-left: 5px" type="button" data-toggle="modal" ><i class="fas fa-id-card-alt text-white"></i></button>
                                <!-- modal de roles -->
                                <div id="my-modal{{$user->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <form action="{{url('user/'.$user->id.'/cambiarRole' )}}" method="post">
                                            @csrf  
                                            {{ method_field('PATCH') }}
                                            <div class="modal-content">
                                                <div class="modal-header bg-purple text center">
                                                    <h5 class="modal-title"><i class="fas fa-id-card-alt text-white"></i>Cambiar rol de usuario</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @forelse ($roles as $rol)
                                                    <p class="mx-auto"><input type="radio" class="form-radio " name="rol" value="{{$rol->id}}" style="border: 1px solid purple;" @if(isset($rol->id))@if( $rol->id == $user->role->id ) checked=""@endif @endif >{{$rol->nombre}}</p>    
                                                    @empty
                                                    no existen roles habiles
                                                    @endforelse
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">cerrar</button>
                                                    <button type="submit" class="btn btn-outline-success">guardar</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                </div>
                                @endif
                                @if (Auth()->user()->role->administrar_usuarios == 1 && Auth()->user()->role->bloquear == 1) 
                                @if(Auth()->user()->id == $user->id)   
                                <div class="container-fluid">
                                    @else
                                    <form class="container-fluid" action="{{url('user/'.$user->id.'/bloquear' )}}" method="post">   
                                        @csrf
                                        {{ method_field('PATCH') }}
                                        @endif
                                        @if($user->status == 1)
                                        <button type="submit" name="status" value="1" @if(Auth()->user()->id == $user->id) class="btn btn-success disabled" @else class="btn btn-success" onclick="return confirm('¿Quieres bloquear a este usuario?')"  value="2"@endif ><i class="fas fa-lock-open"></i></button>
                                        @else 
                                        <button type="submit" name="status" @if(Auth()->user()->id == $user->id) class="btn  btn-danger disabled" @else class="btn  btn-danger" onclick="return confirm('¿Quieres desbloquear a este usuario?')" value="1" @endif ><i class="fas fa-lock"></i></button> 
                                        @endif
                                        @if(Auth()->user()->id == $user->id)       
                                    </div>
                                    @else
                                </form>
                                @endif
                                @endif
                            </div>   

                        </td>
                        @endif
                    </tr>
                    @endforeach  
                    @else
                    <tr>
                        <td class="col-md-2">No existen datos disponibles</td>
                        <td class="col-md-2">No existen datos disponibles</td>
                        <td class="col-md-2">No existen datos disponibles</td>
                        <td class="col-md-2">No existen datos disponibles</td>
                        <td class="col-md-2">No existen datos disponibles</td>
                        <td class="col-md-2">No existe aciones disponibles</td>
                    </tr>
                    @endif
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