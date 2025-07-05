@extends('sources-dashboard')

@section('head-title')

<title>VIAJETUR | PERFIL</title>

@endsection 

@section('content')

<div class="wrapper">
  <form action="{{ route('profile-update') }}" method="POST" class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0"><i class="fas fa-user"></i> CONFIGURACIÓN DEL PERFIL</h4>
          </div>
          <div class="col-sm-6">
            <div class="float-sm-right">
              <a href="{{url('/profile')}}" class="btn btn-dark">REGRESAR</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid my-5">
      <div class="container">
        <div class="row">
          <div class="col-md-8 mx-auto">
            <div class="card">
              <img class="card-img-top" src="{{ asset('static/images/big1.jpg') }}" alt="Imagen Principal" style="height:200px;">
              <div class="card-body">
                <div class="col-md-12">
                  <div class="d-flex justify-content-center">
                    <div class="rounded-circle" style="width: 30%; height: 30%; margin:-20% 0 100px 0;">
                     @if (isset(Auth()->user()->foto))
                     <img src="{{ asset('storage/'.Auth()->user()->foto) }}" alt="Imagen Circular" class="img-fluid rounded-circle w-100 h-100">
                     @else
                     <img src="{{ asset('static/images/user-img.png') }}" alt="Imagen Circular" class="img-fluid rounded-circle w-100 h-100">
                     @endif
                   </div>
                 </div>
               </div>

               <div class="column">
                <div class="row justify-content-center" style="margin:-85px 0 10px 0; ">
                  <h3 clasS="mx-2"></h3>
                  <h3 clasS="mx-2"></h3>
                </div>

                <div class="row justify-content-center">
                  <div class="col-md-6">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                      <label class="h5">Nombre</label>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text bg-purple" style="height: 38px; border:1px solid purple;"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" name="nombre" value="{{Auth()->user()->nombre}}" placeholder="Nombre..." style="border:1px solid purple;">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                      <label class="h5">Apellido</label>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text bg-purple" style="height: 38px; border:1px solid purple;"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" name="apellido" value="{{Auth()->user()->apellido}}" placeholder="Apellido..." style="border:1px solid purple;">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row justify-content-center my-3">
                  <div class="col-md-12">
                    <div class="d-flex flex-column align-items-center">
                      <label class="h5">Correo Electronico</label>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text bg-purple" style="height: 38px; border:1px solid purple;"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" class="form-control" name="email" value="{{Auth()->user()->email}}" placeholder="Correo..." style="height: 38px; border:1px solid purple;">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="d-flex flex-column align-items-center">
                      <label class="h5">Teléfono</label>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text bg-purple" style="height: 38px; border:1px solid purple;"><i class="fas fa-phone"></i></span>
                        </div>
                        <input type="text" class="form-control" name="telefono" value="{{Auth()->user()->telefono}}" placeholder="Telefono..." style="border:1px solid purple;">
                      </div>
                    </div>
                  </div>
                  <div class="text-center mt-2 w-50">
                    <button type="submit" class="btn btn-success w-100">GUARDAR</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @csrf
</form>
</div>
@endsection