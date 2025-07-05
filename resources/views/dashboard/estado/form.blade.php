<div class="card-body">
  <div class="form-group">
    <label for="">Nombre Del Rol</label>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text bg-purple" style="height: 38px; border:1px solid purple;"><i class="fa fa-map-marker-alt"></i></span>
      </div>
      <input type="text" class="form-control" name="nombre" placeholder="Nombre del estado..." value="{{isset($estado->nombre)?$estado->nombre:''}}" style="border:1px solid purple;">
    </div>
    <!--BUTTONS-->
    <div class="text-center">
      @if(Request::routeIs('estado.create'))
      <button class="btn btn-success w-50 mt-3">CREAR</button>

      @else

      <button class="btn btn-success w-50 mt-3">GUARDAR</button>

      @endif
    </div>
  </div>
</div>
<!-- /.card-body -->
