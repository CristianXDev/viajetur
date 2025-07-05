@extends('sources-home')

@section('head-title')

<title>VIAJETUR | PAQUETES TURÍSTICOS</title>

@endsection

@section('content-home')
<body>
   <div id="siteLoader" class="site-loader">
      <div class="preloader-content">
         <img src="{{ asset('static/images/loader1.gif')}}" alt="">
      </div>
   </div>
   <div id="page" class="full-page">
      <header id="masthead" class="site-header header-primary">

         @include('layouts.navbar.nav-home')

         <div class="mobile-menu-container"></div>
      </header>
      <main id="content" class="site-main">
         <!-- Inner Banner html start-->
         <section class="inner-banner-wrap">
            <div class="inner-baner-container" style="background-image:url('{{ asset("static/images/lago20portada.jpg")}}') ;">
               <div class="container">
                  <div class="inner-banner-content">
                     <h1 class="inner-title">Resultados De La Busqueda</h1>
                  </div>
               </div>
            </div>
            <div class="inner-shape"></div>
         </section>
         <!-- Inner Banner html end-->

         <!-- packages html start -->
         <div class="package-section">
            <div class="container">
               <div class="package-inner">
                  <div class="row">
                     @forelse ($paquetes as $paquete)
                     <div class="col-lg-4 col-md-6">
                        <div class="package-wrap" data-aos="fade-up" data-aos-once="true">
                           <figure class="feature-image">
                              <a href="{{ route('package-show',[Str::slug($paquete->nombre),$paquete->id]) }}">
                                 <img src="{{ asset('storage'.'/'.$paquete->foto) }}" class="card-img-top" style="height:200px;" alt="">
                              </a>
                           </figure>
                           <div class="package-price">
                              <h6>
                                 <span>${{$paquete->precio}} </span> / Precio
                              </h6>
                           </div>
                           <div class="package-content-wrap">
                              <div class="package-meta text-center">
                                 <ul class="row">
                                    <li class="text-truncate col m-0 p-0">
                                       <p class="card-text text-truncate"><i class="fas fa-clock"></i><small class="text-white"><strong>Días: </strong>{{$paquete->dias}}</small></p>
                                    </li>
                                    <li class="text-truncate col m-0 p-0">
                                       <p class="card-text text-truncate"><i class="fas fa-users"></i><small class="text-white"><strong>Personas: </strong>{{$paquete->capacidad}}</small></p>
                                    </li>
                                    <li class="text-truncate col m-0 p-0">
                                       <p class="card-text text-truncate"><i class="fas fa-map-marker-alt"></i><small class="text-white"><strong></strong>{{$paquete->destino->nombre}}</small></p>
                                    </li>
                                 </ul>
                              </div>
                              <div class="package-content">
                                 <div class="container-fluid text-center" style="height: 50px">
                                    <h4 class="text-wrap text-break">
                                       <a href="{{ route('package-show',[Str::slug($paquete->nombre),$paquete->id]) }}">{{strtoupper($paquete->nombre)}}</a>
                                    </h4>
                                 </div>
                                 <div class="row mt-0 mb-2 container-fluid p-0 m-0">
                                    <div class="col-md-6 m-0 p-0">
                                       <p class="card-text text-truncate mx-1"><small class="text-muted"><strong>Vistas:( </strong>{{$paquete->vistas}} Vistas<strong>)</strong></small></p> 
                                    </div>
                                    <div class="col-md-6 m-0 p-0">
                                       <p class="card-text text-truncate mx-1"><small class="text-muted"><strong>Reservas:( </strong>{{$paquete->reservas}} Reservas<strong>)</strong></small></p> 
                                    </div>
                                 </div>
                                 <div class="container-fluid text-center" style="height: 150px">
                                    <p class="text-wrap text-break text-sm">{{ Str::limit($paquete->descripcion, 230) }}</p>
                                 </div>
                                 <div class="btn-wrap">
                                    <a href="{{ route('package-show',[Str::slug($paquete->nombre),$paquete->id]) }}" class="button-text width-6">Ver Paquete<i class="fas fa-arrow-right"></i></a>
                                    @php
                                    $verificar = false;
                                    if (Auth()->check()) {

                                       foreach ($paquete->destacado as $comparacion) {
                                          if($comparacion->id_user == Auth()->user()->id){
                                             $verificar = true;
                                          }

                                       }
                                    }
                                    @endphp
                                    @if($verificar == false)
                                    <style>
                                       .destacado{
                                          color: white; 
                                          -webkit-text-stroke:1px red;
                                       }
                                       .destacado:hover{
                                          color: red;  
                                       }
                                    </style>                   
                                    @else
                                    <style>
                                       .destacado{
                                          color: red; 
                                          -webkit-text-stroke:1px red;
                                       }
                                       .destacado:hover{
                                          color: white;  
                                       }
                                    </style> 
                                    @endif
                                    <form action="{{url('destacar/'.$paquete->id.'/destacar')}}" method="POST"> @csrf  {{ method_field('PATCH') }}

                                       <span class="button-text width-6" style="position:absolute;top:15px; left:40px;">

                                          <div class="d-flex">
                                             <span class="mr-2" style="color:#3E4043">Destacar</span>
                                            <input type="hidden" name="id_user" @if(Auth()->check()) value="{{Auth()->user()->id}}" @endif >

                                            <button type="submit" class="btn m-0 p-0" name="id_paquete" value="{{$paquete->id}}"><i class="fas fa-heart destacado" style="position:absolute;top:2px;"></i>
                                            </button>
                                         </div>
                                      </span>
                                   </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     @empty
                     <div class="col-md-12">
                        <div class="d-flex justify-content-center my-5">
                           <h2>No se encontró ningún paquetes</h2>
                      </div>
                   </div>

                   @endforelse
                </div>
             </div>
          </div>
       </div>
       <!-- packages html end -->

    </main>
    @include('layouts.footer.footer-home')

    @endsection