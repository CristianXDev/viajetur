<div class="card-body">
  <div class="form-group">

    <label for="">Nombre Del Rol</label>

    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text bg-purple" style="height: 38px; border:1px solid purple;"><i class="fa fa-user-tag"></i></span>
      </div>
      <input type="text" class="form-control" name="nombre" placeholder="Nombre del rol..." value="{{isset($role->nombre)?$role->nombre:''}}" style="border:1px solid purple;">
    </div>

  </div>
  <div class="form-group text-center">
    <label>Permisos:</label>
      <p>Agregar <input type="checkbox" name="agregar" value="1" @if(isset($role->agregar) && $role->agregar == 1) checked @endif  > </p> 
      <p>Editar <input type="checkbox" name="editar" value="1"  @if(isset($role->editar) && $role->editar == 1)    checked @endif > </p> 
      <p>Borrar <input type="checkbox" name="borrar" value="1"  @if(isset($role->borrar) && $role->borrar == 1)   checked @endif > </p> 
      <p>Bloquear <input type="checkbox" name="bloquear"  @if(isset($role->bloquear) && $role->bloquear == 1)   checked @endif > </p> 
      <p>Administrar Usuarios <input type="checkbox" name="administrar_usuarios" value="1"  @if(isset($role->administrar_usuarios) && $role->administrar_usuarios == 1)   checked @endif > </p> 
      <p>Administrar Pagos <input type="checkbox" name="administrar_pagos" value="1"  @if(isset($role->administrar_pagos) && $role->administrar_pagos == 1)    checked @endif > </p> 
      <p>Administrar Roles <input type="checkbox" name="administrar_roles" value="1"  @if(isset($role->administrar_roles) && $role->administrar_roles == 1)    checked @endif > </p> 
      <p>Administrar Estados <input type="checkbox" name="administrar_estados" value="1"  @if(isset($role->administrar_estados) && $role->administrar_estados == 1)    checked @endif > </p> 
      <p>Administrar Destinos <input type="checkbox" name="administrar_destinos" value="1"  @if(isset($role->administrar_destinos) && $role->administrar_destinos == 1)    checked @endif > </p> 
      <p>Administrar Municipios <input type="checkbox" name="administrar_municipios" value="1"  @if(isset($role->administrar_municipios) && $role->administrar_municipios == 1)    checked @endif > </p>
    <!--BUTTONS-->
    <div class="text-center">
      @if(Request::routeIs('rol.create'))
      <button class="btn btn-success w-50 mt-3">CREAR</button>

      @else

      <button class="btn btn-success w-50 mt-3">GUARDAR</button>

      @endif
    </div>
  </div>
</div>
<!-- /.card-body -->
