@extends('sources-home')

@section('head-title')

<title>VIAJETUR | DESTINOS </title>

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
            <div class="inner-baner-container" style="background-image: url('{{ asset("static/images/cascada-en-mars-hill-carolina-del-norte.jpg") }}');">
               <div class="container">
                  <div class="inner-banner-content">
                     <h1 class="inner-title">Destinos</h1>
                  </div>
               </div>
            </div>
            <div class="inner-shape"></div>
         </section>
         <!-- Inner Banner html end-->


         <!-- search search field html end -->
         <section class="destination-section">
            <div class="container">
               <div class="section-heading">
                  <div class="row align-items-end">
                     <div class="col-lg-7" data-aos="fade-right" data-aos-once="true" data-aos-delay="1000">
                        <h5 class="dash-style">Destinos Populares</h5>
                        <h2>Los Mejores Destinos</h2>
                     </div>
                     <div class="col-lg-5">
                        <div class="section-disc" >
                           <p>¡Los destinos más populares y más nuevos para ti que te gusta viajar y descubrir. Reserva con nosotros los lugares más impresionantes a los que has soñado viajar!</p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="destination-inner destination-three-column">
                  <div class="row">


                     @forelse ($destinos as $destino)
                     @if ( $type < 2)
                     @if ($type == 0)
                     <div class="col-lg-7">
                        <div class="row">   
                           @endif

                           <div class="col-sm-6">
                              <div class="desti-item overlay-desti-item">
                                 <figure class="desti-image">
                                    <img src="{{ asset('storage'.'/'.$destino->foto) }}" class="image-v" alt="">
                                 </figure>
                                 <div class="meta-cat bg-meta-cat">
                                   <a href="{{ route('find_destinate_package',[$destino->id]) }}">{{$destino->estado->nombre}}</a>
                                </div>
                                <div class="desti-content">
                                 <h3>
                                  <a href="{{ route('find_destinate_package',[$destino->id]) }}">{{strtoupper($destino->nombre)}}</a>
                               </h3>
                               <div class="col m-0 p-0">
                                 <p class="card-text text-truncate mx-1"><small class="text-white"><strong>Vistas:( </strong>{{$destino->vistas}} Vistas<strong>)</strong></small></p> 
                              </div>
                           </div>
                        </div>
                     </div>
                     @if ($type == 1)
                  </div>
               </div>   
               @endif
               @php
               $type = $type + 1;
               @endphp

               @else
               @if ($type == 2)
               <div class="col-lg-5">
                  <div class="row">   
                     @endif
                     <div class="col-6 col-12">
                        <div class="desti-item overlay-desti-item">
                           <figure class="desti-image">
                              <img src="{{ asset('storage'.'/'.$destino->foto) }}" class="image-h"  alt="">
                           </figure>
                           <div class="meta-cat bg-meta-cat">
                              <a href="{{ route('find_destinate_package',[$destino->id]) }}">{{$destino->estado->nombre}}</a>
                           </div>
                           <div class="desti-content">
                              <h3>
                                 <a href="{{ route('find_destinate_package',[$destino->id]) }}">{{strtoupper($destino->nombre)}}</a>
                              </h3>
                              <div class="col m-0 p-0">
                                 <p class="card-text text-truncate mx-1"><small class="text-white"><strong>Vistas:( </strong>{{$destino->vistas}} Vistas<strong>)</strong></small></p> 
                              </div>
                           </div>
                        </div>
                     </div>
                     @if ($type == 3)
                  </div>
               </div>   
               @endif
               @php
               if ($type == 3) {
                  $type = 1;
               }else {
                  $type = $type + 1;
               }
               @endphp
               @endif

               @empty
               <h2>no existen</h2> 
               @endforelse  
            </div>
         </div>
      </div>
   </section>
   <!-- Home packages section html start -->
   <!-- destination section html start -->
</main>
@include('layouts.footer.footer-home')

@endsection