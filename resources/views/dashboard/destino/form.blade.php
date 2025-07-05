<div class="card-body">

    <label for="">Nombre Del Destino</label>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text bg-purple" style="height: 38px; border:1px solid purple;"><i class="fa fa-map"></i></span>
        </div>
        <input type="text" class="form-control" name="nombre" placeholder="Nombre Del Destino..." value="{{isset($destino->nombre)?$destino->nombre:''}}" style="border:1px solid purple;">
    </div>

    <label for="">Foto Del Destino</label>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text bg-purple" style="height: 38px; border:1px solid purple;"><i class="fas fa-image"></i></span>
        </div>
        <input type="file" name="foto"  class="form-control py-1" placeholder="ingrece su foto" value="{{isset($destino->foto)?$destino->foto:''}}" style="border:1px solid purple;">
       
    </div>

    @if (!isset($destino->id_estado))
    <label>Seleccione El Estado</label>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text bg-purple" style="height: 38px; border:1px solid purple;"><i class="fa fa-flag"></i></span>
        </div>
        <select name="id_estado" class="custom-select" style="border:1px solid purple;">
            <option value="">Selecione el estado</option>
            @foreach ($estados as $estado)
            <option value="{{$estado->id}}">{{$estado->nombre}}</option>
            @endforeach
        </select>
    </div>
    @else
    <input type="hidden" name="id_estado" value="{{$destino->id_estado}}">
    @endif

    <!--BUTTONS-->
    <div class="text-center">
        @if(Request::routeIs('destino.create'))
        <button class="btn btn-success w-50 mt-3">CREAR</button>

        @else

        <button class="btn btn-success w-50 mt-3">GUARDAR</button>

        @endif
    </div>

</div>
