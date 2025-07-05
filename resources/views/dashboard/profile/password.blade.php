@extends('sources-dashboard')

@section('head-title')

<title>VIAJETUR | PERFIL</title>

@endsection 

@section('content')

<div class="wrapper">
  <form action="{{ route('profile-changePassword') }}" method="POST" class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0"><i class="fas fa-user"></i>CAMBIAR CONTRASEÑA</h4>
          </div>
          <div class="col-sm-6">
            <div class="float-sm-right">
              <a href="{{ route('profile') }}" class="btn btn-dark">REGRESAR</a> 
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
                <div class="column justify-content-center">
                  <div class="row justify-content-center" style="margin:-85px 0 10px 0; ">
                    <h3 clasS="mx-2">{{Auth()->user()->nombre}}</h3>
                    <h3 clasS="mx-2">{{Auth()->user()->apellido}}</h3>
                  </div>
                  <div class="justify-content-center">
                    <div class="col-md-12">
                      <div class="d-flex flex-column justify-content-center align-items-center">
                        <label>Contraseña Antigua</label>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text bg-purple" style="height: 38px; border: 1px solid purple;"><i class="fas fa-key"></i></span>
                          </div>
                          <input type="password" name="oldpassword" class="form-control" placeholder="Contraseña antigua..." style="border: 1px solid purple;" autocomplete="off">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="d-flex flex-column justify-content-center align-items-center">
                        <label>Contraseña Nueva</label>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text bg-purple" style="height: 38px; border: 1px solid purple;"><i class="fas fa-lock"></i></span>
                          </div>
                          <input type="password" name="password" class="form-control" placeholder="Contraseña nueva..." style="border: 1px solid purple;" autocomplete="off">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="d-flex flex-column justify-content-center align-items-center">
                        <label>Repetir Nueva contraseña </label>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text bg-purple" style="height: 38px; border: 1px solid purple;"><i class="fas fa-lock"></i></span>
                          </div>
                          <input type="password" name="password_confirmation" class="form-control" placeholder="Repetir Contraseña nueva..." style="border: 1px solid purple;" autocomplete="off">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row justify-content-center">
                    <input type="submit" class="btn btn-success" value="CAMBIAR CONTRASEÑA">
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