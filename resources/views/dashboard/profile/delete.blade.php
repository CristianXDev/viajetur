@extends('sources-dashboard')

@section('head-title')

<title>VIAJETUR | PERFIL</title>

@endsection 

@section('content')

<div class="wrapper">
  <form action="{{ route('profile-delete') }}" method="POST" class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0"><i class="fas fa-user"></i> CONFIRMARCIÓN PARA ELIMINAR CUENTA</h4>
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
                      <img src="{{ asset('static/adminlte3/dist/img/user2-160x160.jpg') }}" alt="Imagen Circular" class="img-fluid rounded-circle w-100 h-100">
                    </div>
                  </div>
                </div>
                <div class="column justify-content-center">
                  <div class="row justify-content-center" style="margin:-85px 0 10px 0; ">
                    <h3 clasS="mx-2">{{Auth()->user()->nombre}}</h3>
                    <h3 clasS="mx-2">{{Auth()->user()->apellido}}</h3>
                  </div>
                  <div class="row justify-content-center text-primary">
                    <p>@<p>{{Auth()->user()->usuario}}</p></p>
                  </div>
                  <div class="justify-content-center">
                    <div class="col-md-12">
                      <div class="d-flex flex-column justify-content-center align-items-center">
                        <label>Contraseña</label>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text bg-danger border-danger" style="height: 38px;"><i class="fas fa-key"></i></span>
                          </div>
                          <input type="password" name="password" class="form-control" placeholder="Contraseña...">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="d-flex flex-column justify-content-center align-items-center">
                        <label>Repetir contraseña</label>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text bg-danger border-danger" style="height: 38px;"><i class="fas fa-lock"></i></span>
                          </div>
                          <input type="password" name="password_confirmation" class="form-control" placeholder="Repetir Contraseña...">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row justify-content-center">
                    <input type="submit" onclick="return confirm('¿Quieres borrar tu cuenta definitivamente?')" class="btn btn-danger" value="¡ELIMINAR CUENTA!">
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