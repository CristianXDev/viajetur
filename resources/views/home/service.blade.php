@extends('sources-home')

@section('head-title')

<title>VIAJETUR | SERVICIOS</title>

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
            <div class="inner-baner-container" style="background-image: url(' {{ asset("static/images/blog-6.jpg") }}');">
               <div class="container">
                  <div class="inner-banner-content">
                     <h1 class="inner-title">Servicios</h1>
                  </div>
               </div>
            </div>
            <div class="inner-shape"></div>
         </section>
         <!-- Inner Banner html end-->
         <!-- service html start -->
         <div>
            <div class="container">
               <div class="row">
                  <div class="col-md-6">
                     <div class="service-content-wrap" data-aos="fade-up" data-aos-once="true" data-aos-delay="500">
                        <div class="service-content">
                           <div class="service-header">
                              <span class="service-count">
                                 01.
                              </span>
                              <h3>Viajes Seguros</h3>
                           </div>
                           <p>Muchos de nuestros paquetes ofrecen un seguro contra situaciones inesperadas, como cancelación o interrupción del viaje, perdida o retraso del equipaje, retrasos en los viajes, entre otros términos aprobados por el proveedor.</p>
                        </div>
                        <figure class="service-img">
                           <img src="{{ asset('static/images/seguro-viaje.png') }}" class="service-size" alt="">
                        </figure>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="service-content-wrap" data-aos="fade-up" data-aos-once="true" data-aos-delay="750">
                        <div class="service-content">
                           <div class="service-header">
                              <span class="service-count">
                                 02.
                              </span>
                              <h3>Variedad Hotels</h3>
                           </div>
                           <p>Disponemos de una gran variedad de hoteles donde podrás elegir el más acorde a tu gusto y tu bolsillo, en el país o región que más desee y disfrutar sus viajes o excursiones.</p>
                        </div>
                        <figure class="service-img">
                           <img src="{{ asset('static/images/hotel.jpg') }}" class="service-size" alt="">
                        </figure>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="service-content-wrap" data-aos="fade-up" data-aos-once="true" data-aos-delay="500">
                        <div class="service-content">
                           <div class="service-header">
                              <span class="service-count">
                                 03.
                              </span>
                              <h3>Accesibilidad</h3>
                           </div>
                           <p>Contamos con una estructura intuitiva para el uso de cada usuario donde podrá registrarse, ingresar  y reservar de forma cómoda para cada usuario.</p>
                        </div>
                        <figure class="service-img">
                           <img src="{{ asset('static/images/Accesibilidad.png') }}" class="service-size" alt="">
                        </figure>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="service-content-wrap" data-aos="fade-up" data-aos-once="true" data-aos-delay="750">
                        <div class="service-content">
                           <div class="service-header">
                              <span class="service-count">
                                 04.
                              </span>
                              <h3>Soporte 24/7</h3>
                           </div>
                           <p>Ofrecemos un servicio de atención para sus dudas, comentarios o sugerencias donde uno de los operadores atenderá a su respuesta lo más pronto posible.</p>
                        </div>
                        <figure class="service-img">
                           <img src="{{ asset('static/images/24-7.jpg') }}" class="service-size" alt="">
                        </figure>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- service html end -->

      </main>

      @include('layouts.footer.footer-home')

@endsection