@extends('sources-dashboard')

@section('head-title')

<title>VIAJETUR | PROFILE</title>

@endsection

@section('content')

<div class="wrapper">
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0"><i class="fas fa-user"></i> INFORMACIÓN DEL PERFIL</h4>
          </div>
          <div class="col-sm-6">
            <div class="float-sm-right">
              <a href="{{url('/dashboard')}}" class="btn btn-dark">REGRESAR</a>
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

                <div class="column">
                  <div class="row justify-content-center mb-4" style="margin:-85px 0 10px 0; ">
                    <h3 clasS="mx-2">{{Auth()->user()->nombre}}</h3>
                    <h3 clasS="mx-2">{{Auth()->user()->apellido}}</h3>
                  </div>

                  <div class="row mt-3 mb-5">
                    <div class="col-md-6">
                      <div class="d-flex flex-column align-items-center">
                        <h5><strong>Correo Electronico:</strong></h5>
                        <span>{{Auth()->user()->email}}</span>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="d-flex flex-column align-items-center">
                        <h5><strong>Teléfono:</strong></h5>
                      
                        @if(!isset(Auth()->user()->telefono))

                        <span>No Hay Telefono Asociado</span>

                        @else

                        <span>{{Auth()->user()->telefono}}</span>

                        @endif

                      </div>
                    </div>
                  </div>

                  <div class="row mt-3 mb-5">
                    <div class="col-md-12">
                      <div class="d-flex flex-column align-items-center">
                        <h5><strong>Cédula:</strong></h5>
                        <span>{{Auth()->user()->cedula}}</span>
                      </div>
                    </div>

                  </div>

                  <div class="row justify-content-center">
                    <a href="{{ route('profile-edit') }}" class="btn btn-primary mx-1">EDITAR PERFIL</a>
                    <a href="{{ route('profile-trash') }}" class="btn btn-danger mx-1">BORRAR PERFIL</a>
                    <a href="{{ route('profile-password') }}" class="btn btn-info mx-1">CAMBIAR CONTRASEÑA</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    @endsection