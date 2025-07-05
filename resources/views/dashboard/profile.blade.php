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
              @if (!isset(Auth()->user()->proveedor))   
              <button class="btn btn-secondary" style="position:absolute; top: 10px; left:10px;" type="button" data-toggle="modal" data-target="#proveedor">Convertise en proveedor</button>
              <div id="proveedor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <form  action="{{url('proveedor/agregar')}}"  method="post" class="modal-content" enctype="multipart/form-data">
                    <div class="modal-header">
                      <h5 class="modal-title" id="my-modal-title">Ingrese su RIF</h5>
                      <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text bg-purple" style="height: 38px; border:1px solid purple;"><i class="fas fa-id-card"></i></span>
                        </div>
                        <input type="text" name="rif" class="form-control py-1" placeholder="Ingrese su RIF" style="border:1px solid purple;">
                      </div>
                      <input type="hidden" name="id_user" value="{{Auth()->user()->id}}">
                      @csrf
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="submit" class="btn btn-outline-success">Guardar</button>
                      <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
                    </div>
                  </form>
                </div>
              </div>
              @endif
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
                      <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#foto" style="border-radius: 100%;position:absolute; top:1%;"><i class="fas fa-pen"></i></button>
                      <!--modal para cambiar foto-->
                      <div id="foto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">  
                          <form  action="{{url('profile/foto/'.Auth()->user()->id)}}"  method="post" class="modal-content" enctype="multipart/form-data">
                            <div class="modal-header">
                              <h5 class="modal-title" id="my-modal-title">Agregar foto para el usuario</h5>
                              <button class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text bg-purple" style="height: 38px; border:1px solid purple;"><i class="fas fa-image"></i></span>
                                </div>
                                <input type="file" name="foto"  class="form-control py-1" placeholder="ingrece su foto" style="border:1px solid purple;" required>
                              </div>
                              {{method_field('PATCH')}}
                              @csrf
                            </div>
                            <div class="modal-footer justify-content-between">
                              <button type="submit" class="btn btn-outline-success">Guardar</button>
                              <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
                            </div>

                          </form>
                        </div>
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

                          <span>No hay telefono asociado</span>

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

                    <div class="container-fluid">
                      <div class="row justify-content-center">
                        <a href="{{ route('profile-edit') }}" class="btn btn-primary mx-1">EDITAR PERFIL</a>
                        <a href="{{ route('profile-password') }}" class="btn btn-info mx-1">CAMBIAR CONTRASEÑA</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      @endsection