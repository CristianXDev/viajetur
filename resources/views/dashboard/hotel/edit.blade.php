@extends('sources-dashboard')

@section('head-title')

<title>VIAJETUR | ¡EDITAR HOTEL!</title>

@endsection

@section('content')
    
<div class="wrapper">
    <form action="{{url('/hotel/'.$hotel->id)}}" method="POST" class="content-wrapper" enctype="multipart/form-data">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="m-0"><i class="fas fa-hotel"></i> EDITAR HOTEL</h4>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-sm-right">
                            <a href="{{url('hotel')}}" class="btn btn-dark">REGRESAR</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="col-md-8 mx-auto">
                <div class="card card-primary">
                    @if (!empty($hotel->foto1))
                    <img src="{{asset('storage'.'/'.$hotel->foto1)}}" alt="" class="card-img-top"  style="height:200px;">
                    @else    
                    <img class="card-img-top" src="{{ asset('static/images/556465950.jpg') }}" alt="Imagen Principal" style="height:200px;">
                    @endif

                    <div class="container">
                        <div class="mx-auto" style="width:100px; height:100px;">
                            <div class=" rounded-circle bg-purple text-white text-center py-3" style="margin-top:-50px;">
                                <h1><i class="fas fa-hotel"></i></h1>
                            </div>
                        </div>

                        <div class="text-center">
                            <h4>- HOTEL -</h4>
                        </div>

                    </div>
                    @include('dashboard.hotel.form')
                    @csrf
                    {{ method_field('PATCH') }}
                    </div>
                </div>
            </div>  
        </div>
    </form>
</div>

@endsection
