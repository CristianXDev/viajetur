@extends('sources-dashboard')

@section('head-title')

<title>VIAJETUR | EDITAR ESTADOS</title>

@endsection

@section('content')

<div class="wrapper">
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="m-0"><i class="fa fa-map-marker-alt"></i> EDITAR ESTADOS</h4>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-sm-right">
                            <a href="{{url('/estado')}}" class="btn btn-dark">REGRESAR</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container my-5">
            <div class="col-md-8 mx-auto">
                <div class="card card-primary">
                    <img class="card-img-top" src="{{ asset('static/images/destinos.jpg') }}" alt="Imagen Principal" style="height:200px;">
                    <div class="container">
                        <div class="mx-auto" style="width:100px; height:100px;">
                            <div class=" rounded-circle bg-purple text-white text-center py-3" style="margin-top:-50px;">
                                <h1><i class="fa fa-map-marker-alt"></i></h1>
                            </div>
                        </div>

                        <div class="text-center">
                            <h4>- ESTADOS -</h4>
                        </div>

                    </div>
                    <form  action="{{url('/estado/'.$estado->id)}}" method="post">
                        @csrf
                        {{ method_field('PATCH') }}
                        @include('dashboard.estado.form')
                    </form>
                </div>
            </div>  
        </div>
    </div>
</div>

@endsection