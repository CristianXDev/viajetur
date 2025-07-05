@extends('sources-dashboard')

@section('head-title')

<title>VIAJETUR | CREAR ROLES</title>

@endsection

@section('content')

<div class="wrapper">
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="m-0"><i class="fa fa-user-tag"></i> CREAR ROLES</h4>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-sm-right">
                            <a href="{{url('/role')}}" class="btn btn-dark">REGRESAR</a>
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
                                <h1><i class="fa fa-user-tag"></i></h1>
                            </div>
                        </div>
                        <div class="text-center">
                            <h4>- ROLES -</h4>
                        </div>
                    </div>
                    <form  action="{{url('/role/')}}" method="post">
                        @csrf
                        @include('dashboard.rol.form')
                    </form>
                </div>
            </div>  
        </div>
    </div>
</div>

@endsection