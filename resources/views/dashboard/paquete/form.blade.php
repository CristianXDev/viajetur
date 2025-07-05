<div class="card-body">

  <label>Foto 1 Del Paquete</label>
  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text bg-purple" style="height: 38px; border:1px solid purple;"><i class="fas fa-image"></i></span>
    </div>
    <input type="file" name="foto"  class="form-control py-1" placeholder="ingrece su foto" style="border:1px solid purple;">

  </div>

  <label for="">Nombre</label>
  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text bg-purple" style="height: 38px; border:1px solid purple;"><i class="fas fa-hiking"></i></span>
    </div>
    <input type="text" class="form-control" name="nombre" placeholder="Nombre de la paquete..." value="{{isset($paquete->nombre)?$paquete->nombre:''}}" style="border:1px solid purple;">
  </div>

  <label for="">Dias</label>
  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text bg-purple" style="height: 38px; border:1px solid purple;"><i class="fas fa-calendar"></i></span>
    </div>
    <input type="number" class="form-control" name="dias" placeholder="Dias que durará el paquete..." value="{{isset($paquete->dias)?$paquete->dias:''}}" min="1" style="border:1px solid purple;">
  </div>

  <label for="">Noches</label>
  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text bg-purple" style="height: 38px; border:1px solid purple;"><i class="fas fa-calendar"></i></span>
    </div>
    <input type="number" class="form-control" name="noches" placeholder="Moches que durará el paquete..." value="{{isset($paquete->noches)?$paquete->noches:''}}" min="0" style="border:1px solid purple;">
  </div>

  <div class="form-group">
    <label >Descripción</label>
    <textarea class="form-control" name="descripcion" cols="35" rows="5" placeholder="descripcion del hotel">{{isset($paquete->descripcion)?$paquete->descripcion:''}}</textarea>
  </div>

  <div class="form-group">
    @isset($destinos)   
    <label class="h5 text-center">Destino:</label> 
    <div class="input-group">
      <select name="id_destino" class="custom-select">
        <option value="">Selecione el destino</option>
        @forelse ($destinos as $destino)
        <option value="{{$destino->id}}">{{$destino->nombre}}</option>
        @empty
        <option value="">No hay destinos disponibles</option>
        @endforelse      
      </select>
    </div>
  </div>
  @endisset
  @if (isset($paquete->id_destino))
  <div class="col-md-12 text-center">
    <label class="h5">Destino: {{$paquete->destino->nombre}}</label>
    <input type="hidden" name="id_destino" value="{{$paquete->id_destino}}">
  </div>
  @endif

  @isset($hoteles)

  @if (!isset($paquete->id_hotel))
  <label for="">Hotel</label>
  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text bg-purple" style="height: 38px; border:1px solid purple;"><i class="fas fa-hotel"></i></span>
    </div>
    <select name="id_hotel" class="custom-select" style="border:1px solid purple;">
      <option value="">Seleccione el hotel</option>
      @forelse ($hoteles as $hotel)
      <option value="{{$hotel->id}}">{{$hotel->destino->nombre}}: {{$hotel->nombre}}</option>
      @empty
      <option value="">No hay destinos disponibles</option>
      @endforelse      
    </select>
  </div>
  @else
  <div class="col-md-12 text-center">
    <label class="h5">Hotel actual: {{$paquete->hotel->nombre}}</label>  
    <input type="hidden" name="id_hotel" value="{{$paquete->id_hotel}}">
  </div>
  @endif


  @endisset

      <!--if (isset($paquete->id_hotel))
        <label class="text-center h5">Hotel actual: {{--$paquete->hotel->nombre--}}</label>  
        <input type="hidden" name="id_hotel" value="{{--$paquete->id_hotel--}}">
        endif-->



        <label for="">Capacidad</label>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text bg-purple" style="height: 38px; border:1px solid purple;"><i class="fas fa-users"></i></span>
          </div>
          <input type="number" class="form-control" min="1" name="capacidad" placeholder="Número de personas..." value="{{isset($paquete->capacidad)?$paquete->capacidad:''}}" style="border:1px solid purple;">
        </div> 


        <label for="">Precio</label>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text bg-purple" style="height: 38px; border:1px solid purple;"><i class="fas fa-dollar-sign"></i></span>
          </div>
          <input type="number" class="form-control" name="precio" placeholder="Precio del paquete..." value="{{isset($paquete->precio)?$paquete->precio:''}}" min="{{isset($paquete->hotel->precio)?$paquete->hotel->precio:'1'}}" style="border:1px solid purple;">
        </div>
      </div>
