<div class="card-body">
    <div class="form-group">
        <label for="">Nombre Del Municipio</label>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text bg-purple" style="height: 38px; border:1px solid purple;"><i class="fa fa-map-marker-alt"></i></span>
        </div>
        <input type="text" class="form-control" name="nombre" placeholder="Nombre del municipio" value="{{isset($municipio->nombre)?$municipio->nombre:''}}" style="border:1px solid purple;">
    </div>

</div>
@if (!isset($municipio->id_estado))
<div class="form-group">
    <div class="input-group">
        <label for="">Localización Del Municipio</label>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text bg-purple" style="height: 38px; border:1px solid purple;"><i class="fa fa-map-marker-alt"></i></span>
        </div>
        <select name="id_estado" class="custom-select" style="border:1px solid purple;">>
            <option value="">Seleccione el estado</option>
            @foreach ($estados as $estado)
            <option value="{{$estado->id}}">{{$estado->nombre}}</option>
            @endforeach
        </select> 
    </div>
</div>
</div>
@else
<input type="hidden" name="id_estado" value="{{$municipio->id_estado}}">
@endif
<!--BUTTONS-->
<div class="text-center">
    @if(Request::routeIs('municipio.create'))
    <button class="btn btn-success w-50 mt-3">CREAR</button>

    @else

    <button class="btn btn-success w-50 mt-3">GUARDAR</button>

    @endif
</div>

</div>
<!-- /.card-body -->
