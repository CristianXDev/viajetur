@extends('sources-dashboard')

@section('head-title')

<title>VIAJETUR | CREAR PAQUETE</title>

@endsection

@section('content')

<div class="wrapper">
    <div class="content-wrapper">
     <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0"><i class="fas fa-hiking"></i> CREAR PAQUETE</h4>
                </div>
                <div class="col-sm-6">
                    <div class="float-sm-right">
                        <a href="{{url('paquete')}}" class="btn btn-dark">REGRESAR</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="col-md-8 mx-auto">
            <form class="card card-primary" action="{{url('/paquete/')}}" method="post" enctype="multipart/form-data">


                <img class="card-img-top" src="{{ asset('static/images/556465950.jpg') }}" alt="Imagen Principal" style="height:200px;">


                <div class="container">
                    <div class="mx-auto" style="width:100px; height:100px;">
                        <div class=" rounded-circle bg-purple text-white text-center py-3" style="margin-top:-50px;">
                            <h1><i class="fas fa-hiking"></i></h1>
                        </div>
                    </div>

                    <div class="text-center">
                        <h4>- CREAR DEL PAQUETE -</h4>
                    </div>

                </div>

                @csrf
                @include('dashboard.paquete.form')
                <div class="text-center my-3">
                    <button type="submit" class="btn btn-success w-50">GUARDAR</button>
                </div>
            </form>
        </div>
    </div> 
</div>
</div>
</div>


@endsection

