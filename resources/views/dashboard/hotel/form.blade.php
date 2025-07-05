<div class="card-body">
  
  <label for="">Foto Del Hotel</label>

  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text bg-purple" style="height: 38px; border:1px solid purple;"><i class="fas fa-image"></i></span>
    </div>
    <input type="file" name="foto"  class="form-control py-1" placeholder="ingrece su foto" style="border:1px solid purple;">

  </div>

  <label>Nombre Del Hotel</label>
  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text bg-purple" style="height: 38px; border:1px solid purple;"><i class="fas fa-hotel"></i></span>
    </div>
    <input type="text" class="form-control" name="nombre" placeholder="Nombre Del Hotel..." value="{{isset($hotel->nombre)?$hotel->nombre:''}}" style="border: 1px solid purple;">
  </div>

  @if(isset($hotel->estado))
  <label>Estado</label>
  <div class="input-group mb-3">
    <h4 class="mx-auto row form-control bg-success border-success"><input type="radio" class="p-0 m-0" name="estado" value="1" @if( $hotel->estado == 1) checked=""@endif> Activo</h4>
    <h4 class="mx-auto row form-control bg-danger border-danger"><input type="radio" class="p-0 m-0" name="estado" value="2" @if( $hotel->estado == 2) checked=""@endif> Inactivo</h4>
  </div>  
  @endif

  <label>Categoria Del Hotel</label>
  <div class="input-group mb-3">
    <p class="mx-auto"><input type="radio" class="form-control " name="categoria" value="1" style="border: 1px solid purple;" @if(isset($hotel->categoria))@if( $hotel->categoria == 1) checked=""@endif @else checked="" @endif >Una Estrella: <i class="fas fa-star text-warning"></i></p>
    <p class="mx-auto"><input type="radio" class="form-control " name="categoria" value="2" style="border: 1px solid purple;" @if(isset($hotel->categoria))@if( $hotel->categoria == 2) checked=""@endif @endif >Dos Estrellas: <i class="fas fa-star text-warning"></i> <i class="fas fa-star text-warning"></i></p>
    <p class="mx-auto"><input type="radio" class="form-control " name="categoria" value="3" style="border: 1px solid purple;" @if(isset($hotel->categoria))@if( $hotel->categoria == 3) checked=""@endif @endif >Tres Estrellas: <i class="fas fa-star text-warning"></i> <i class="fas fa-star text-warning"></i> <i class="fas fa-star text-warning"></i></p>
    <p class="mx-auto"><input type="radio" class="form-control " name="categoria" value="4" style="border: 1px solid purple;" @if(isset($hotel->categoria))@if( $hotel->categoria == 4) checked=""@endif @endif >Cuatro Estrellas: <i class="fas fa-star text-warning"></i> <i class="fas fa-star text-warning"></i> <i class="fas fa-star text-warning"></i> <i class="fas fa-star text-warning"></i></p>
    <p class="mx-auto"><input type="radio" class="form-control " name="categoria" value="5" style="border: 1px solid purple;" @if(isset($hotel->categoria))@if( $hotel->categoria == 5) checked=""@endif @endif >Cinco Estrellas: <i class="fas fa-star text-warning"></i> <i class="fas fa-star text-warning"></i> <i class="fas fa-star text-warning"></i> <i class="fas fa-star text-warning"></i> <i class="fas fa-star text-warning"></i></p>
  </div>

  <div class="form-group">
    <label>Descripción Del Hotel</label>
    <textarea class="form-control" name="descripcion" cols="35" rows="5" placeholder="Descripción Del Hotel..." style="border: 1px solid purple;">{{isset($hotel->descripcion)?$hotel->descripcion:''}}</textarea>
  </div>


  <label>Correo Electronico</label>
  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text bg-purple" style="height: 38px; border:1px solid purple;"><i class="fas fa-envelope"></i></span>
    </div>
    <input type="text" class="form-control" name="correo" placeholder="Correo Del Hotel..." value="{{isset($hotel->correo)?$hotel->correo:''}}" style="border: 1px solid purple;">
  </div>

  <label>Teléfono</label>
  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text bg-purple" style="height: 38px; border:1px solid purple;"><i class="fa fa-phone"></i></span>
    </div>
    <input type="text" class="form-control" name="telefono" placeholder="Telefono Del Hotel..." value="{{isset($hotel->telefono)?$hotel->telefono:''}}" style="border: 1px solid purple;">
  </div>

  <!--<label>Whatsapp</label>
  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text bg-purple" style="height: 38px; border:1px solid purple;"><i class="fab fa-whatsapp"></i></span>
    </div>
    <input type="text" class="form-control" name="whatsapp" placeholder="Whatsapp Del Hotel..." value="{{isset($hotel->whatsapp)?$hotel->whatsapp:'+31'}}" style="border: 1px solid purple;">
  </div>-->

  
  @if (!isset($hotel->id_destino))
  <label>Localizacion Del Destino</label>
  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text bg-purple" style="height: 38px; border:1px solid purple;"><i class="fa fa-map-marker-alt"></i></span>
    </div>
    <select name="id_destino" class="custom-select" style="border: 1px solid purple;">
      <option value="">Selecione El Destino</option>
      @foreach ($destinos as $destino)
      <option value="{{$destino->id}}">{{$destino->nombre}}</option>
      @endforeach
    </select>
  </div>
  @else
  <input type="hidden" name="id_destino" value="{{$hotel->id_destino}}" style="border: 1px solid purple;">
  @endif

  <label for="">Precio De La Habitación</label>

  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text bg-purple" style="height: 38px; border:1px solid purple;"><i class="fas fa-dollar-sign"></i></span>
    </div>
    <input type="number" class="form-control" min="1" name="precio" placeholder="Precio del hotel..." value="{{isset($hotel->precio)?$hotel->precio:''}}" style="border: 1px solid purple;">
  </div>
  <!--BUTTONS-->
  <div class="text-center">
    @if(Request::routeIs('hotel.create'))
    <button class="btn btn-success w-50 mt-3">CREAR</button>

    @else

    <button class="btn btn-success w-50 mt-3">GUARDAR</button>

    @endif
  </div>
</div>
