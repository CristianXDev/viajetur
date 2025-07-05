@extends('sources-home')

@section('head-title')

<title>VIAJETUR | INICIO </title>

@endsection

@section('content-home')
</head>
<body class="home">
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
         <!-- Home slider html start -->
         <section class="home-slider-section">
            <div class="home-slider">
               <div class="home-banner-items">
                  <div class="banner-inner-wrap" style="background-image: url('{{ asset("static/images/el-valle-justis-en-suiza.jpg") }}');"></div>
                  <div class="banner-content-wrap">
                     <div class="container">
                        <div class="banner-content text-center">
                           <h2 class="banner-title">Tu mejor opción de viajes</h2>
                           <p>Tu mejor opción en reservación de viajes y paquetes turísticos, de la forma más cómoda al lugar, en el tiempo y con el presupuesto que desee, reserva de la forma más cómoda. Descubre más uniéndote a esta gran comunidad.</p>
                           @auth
                           @if (Auth()->user()->nombre && Auth()->user()->apellido)
                           <a href="{{route('dashboard')}}" class="button-primary bold">{{Auth()->user()->nombre}} {{Auth()->user()->apellido}}</a>
                           @else
                           <a href="{{route('dashboard')}}" class="button-primary bold">{{Auth()->user()->correo}}</a>
                           @endif
                           @else  
                           <a href="{{route('register')}}" class="button-primary">¡Registrate!</a>
                           @endauth
                        </div>
                     </div>
                  </div>
                  <div class="overlay"></div>
               </div>
               <div class="home-banner-items">
                  <div class="banner-inner-wrap" style="background-image: url('{{ asset("static/images/el-bosque-en-otono.jpg") }}')";></div>
                  <div class="banner-content-wrap">
                     <div class="container">
                        <div class="banner-content text-center">
                           <h2 class="banner-title">Descubre nuevas experiencias</h2>
                           <p>Tu mejor opción en reservación de viajes y paquetes turísticos, de la forma más cómoda al lugar, en el tiempo y con el presupuesto que desee, reserva de la forma más cómoda. Descubre más uniéndote a esta gran comunidad.</p>
                           @auth
                           <a href="{{route('dashboard')}}" class="button-primary bold">{{Auth()->user()->nombre}} {{Auth()->user()->apellido}}</a>
                           @else     
                           <a href="{{route('login')}}" class="button-primary">¡Inicia sesión!</a>
                           @endauth
                        </div>
                     </div>
                  </div>
                  <div class="overlay"></div>
               </div>
            </div>
         </section>
         <!-- slider html start -->
         <!-- Home search field html start -->
         <div class="trip-search-section shape-search-section" data-aos="fade-up" data-aos-once="true">
            <div class="slider-shape"></div>
            <form action="{{ route('find_package') }}" method="POST" class="container">
               <div class="trip-search-inner white-bg d-flex">
                  <div class="input-group">
                     <label>¿Cuál es su destino?</label>
                     <select name="destino" class="w-100">
                        <option value="">Seleccione un destino...</option>
                        @foreach($destinos as $destino)
                        <option value="{{ $destino->id }}">{{$destino->nombre}}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="input-group">
                     <label>¿Cuántos serán?</label>
                     <select name="capacidad" class="w-100">
                        <option value="">Seleccione una opción...</option>
                        <option value="1">1 Persona</option>
                        <option value="2">2 Personas</option>
                        <option value="3">3 Personas</option>
                        <option value="4">4 Personas</option>
                        <option value="5">5 Personas</option>
                        <option value="6">6 Personas</option>
                        <option value="7">7 Personas</option>
                        <option value="8">8 Personas</option>
                        <option value="9">9 Personas</option>
                        <option value="10">10 Personas</option>
                     </select>
                  </div>
                  <div class="input-group">
                     <label>Rango minimo de precio</label>
                     <input type="number" min="1" value="10" name="precioMin" style="border-bottom:1px solid #383838;" class="w-100" placeholder="Rango minimo de precio ($)" required>
                  </div>
                  <div class="input-group">
                     <label>Rango maximo de precio</label>
                     <input type="number" min="1" value="50" name="precioMax" style="border-bottom:1px solid #383838;" class="w-100" placeholder="Rango maximo de precio ($)" required>
                  </div>
                  <div class="input-group width-col-3">
                     <label class="screen-reader-text"> ¡Buscar! </label>
                     <input type="submit" name="travel-search" value="Buscar Ahora" style="border-bottom:0"><i class="text-white fa fa-search" aria-hidden="true"></i>
                  </div>
               </div>
               @csrf
            </form>
         </div>
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
                  <div class="btn-wrap text-center">
                     <a href="{{ route('destination') }}" class="button-primary">Descubre Mas Destinos <i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                  </div>
               </div>
            </div>
         </section>
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
                                    <p class="text-wrap text-break text-sm">{{ Str::limit($paquete->descripcion, 240) }}</p>
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

                    <div class="mx-auto">
                     <h2>No hay paquetes</h2>
                  </div>


                  @endforelse
               </div>
            </div>

            @if(isset($paquete))
            <div class="btn-wrap text-center">
               <a href="{{ route('tour') }}" class="button-primary">Descubre Más Paquetes <i class="fa fa-plus-circle" aria-hidden="true"></i></a>
            </div>
            @endif

         </div>
      </div>


      <!-- Home subscribe section html start -->
      <section class="subscribe-section mt-1" style="background-image: url(' {{ asset("static/images/img16.jpg") }} ');">

         <div class="container">
            <div class="row">
               <div class="col-lg-7">
                  <div class="section-heading section-heading-white" data-aos="fade-up" data-aos-once="true">
                     <h5 class="dash-style">Ofertas de paquetes vacacionales</h5>
                     <h2>Vacaciones especiales con una oferta del 25%!</h2>
                     <h4>Siguenos para mas informacion y actualizaciones en nuestros planes!!</h4>
                     <div class="newsletter-form">
                        <form action="{{ route('suscribe-mail') }}" method="POST">

                           <input type="email" name="email" placeholder="ingrese su correo para mas">
                           <input type="submit" value="¡Siguenos ahora!">

                           @csrf
                        </form>
                     </div>
                     <p class="mb-des">Estás ofertas te permitirán conocer algunos de los lugares más emblemáticos del mundo, con la comodidad de tener todo organizado y planificado. Aunque no incluye todas las atracciones y actividades que ofrecen, es una opción económica y accesible para quienes quieren conocer el mundo sin gastar demasiado.</p>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- subscribe html end -->
      <!-- Home testimonial section html start -->
      <div class="testimonial-section" style="background-image: url(' {{ asset("static/images/img23.jpg") }}');">
         <div class="container">
            <div class="row">
               <div class="col-lg-10 offset-lg-1">
                  <div class="testimonial-inner testimonial-slider">
                     <div class="testimonial-item text-center">
                        <figure class="testimonial-img">
                           <img src="{{ asset('static/images/img20.jpg') }}" alt="">
                        </figure>
                        <div class="testimonial-content">
                           <p>" Viajar nos brinda la oportunidad de explorar lugares que nunca antes habíamos visto, experimentar nuevas culturas, probar diferentes comidas y aprender sobre la historia y las tradiciones de otros lugares! "</p>
                           <cite>
                              Johny English
                              <span class="company">Agente de viajes</span>
                           </cite>
                        </div>
                     </div>
                     <div class="testimonial-item text-center">
                        <figure class="testimonial-img">
                           <img src="{{ asset('static/images/img21.jpg') }}" alt="">
                        </figure>
                        <div class="testimonial-content">
                           <p>" Salir de nuestra zona de confort y experimentar algo nuevo puede ser muy emocionante y liberador, además de ayudarnos a relajarnos y desconectarnos de la rutina diaria! "</p>
                           <cite>
                              William Housten
                              <span class="company">Agente de viajes</span>
                           </cite>
                        </div>
                     </div>
                     <div class="testimonial-item text-center">
                        <figure class="testimonial-img">
                           <img src="{{ asset('static/images/img22.jpg') }}" alt="">
                        </figure>
                        <div class="testimonial-content">
                           <p>" Los viajes nos brindan la oportunidad de vivir experiencias únicas e inolvidables con amigos y familiares, y crear recuerdos que durarán toda la vida. Ademas estos recuerdos pueden ser compartidos con otros y nos permiten recordar y revivir momentos especiales en el futuro! " </p>
                           <cite>
                              Alison Wright
                              <span class="company">guia turistico</span>
                           </cite>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- testimonial html end -->
   </main>

   @include('layouts.footer.footer-home')

   @endsection