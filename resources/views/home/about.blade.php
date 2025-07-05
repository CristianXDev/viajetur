@extends('sources-home')

@section('head-title')

<title>VIAJETUR | ACERCA DE</title>

@endsection

@section('content-home')
<body>
   <div id="siteLoader" class="site-loader">
      <div class="preloader-content">
         <img src="{{ asset('static/images/loader1.gif') }}" alt="">
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
         <div class="inner-baner-container" style="background-image: url('{{ asset("static/images/slider-banner-2.jpg") }}');">
            <div class="container">
               <div class="inner-banner-content">
                  <h1 class="inner-title">Acerca de</h1>
               </div>
            </div>
         </div>
         <div class="inner-shape"></div>
      </section>
      <!-- Inner Banner html end-->
      <!-- about section html start -->
      <section class="about-section about-page-section">
         <div class="about-service-wrap">
            <div class="container">
               <div class="section-heading">
                  <div class="row align-items-end">
                     <div class="col-lg-6" data-aos="fade-right" data-aos-once="true">
                        <h5 class="dash-style">NUESTRA GALERIA DE TOURS</h5>
                        <h2>NUESTRA AGENCIA HA ESTADO COMO LA MEJOR DEL MERCADO</h2>
                     </div>
                     <div class="col-lg-6">
                        <div class="section-disc">
                           <p>Contamos con una amplia experiencia y un equipo experto, ofrecemos los destinos más fascinantes, los itinerarios más completos y los servicios personalizados que supera todas las expectativas</p>
                           <p>Descube el mundo con nostros y dejanos mostrarte por que somos la elección número uno para aquellos que buscan experiencia inolvidables y un servicio excepcional..</p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="about-service-container">
                  <div class="row">
                     <div class="col-lg-4">
                        <div class="about-service">
                           <div class="about-service-icon">
                              <img src="{{ asset('static/images/icon15.png') }}" alt="">
                           </div>
                           <div class="about-service-content">
                              <h4>Precio Accesible</h4>
                              <p>Cada paquete es acorde al precio mas razonable para el cliente.</p>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-4">
                        <div class="about-service">
                           <div class="about-service-icon">
                              <img src="{{ asset('static/images/icon16.png') }}" alt="">
                           </div>
                           <div class="about-service-content">
                              <h4>Los Mejores Destinos</h4>
                              <p>Destinos de la mas alta calidad por todo el mundo.</p>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-4">
                        <div class="about-service">
                           <div class="about-service-icon">
                              <img src="{{ asset('static/images/icon17.png') }}" alt="">
                           </div>
                           <div class="about-service-content">
                              <h4>Servicio personalizado</h4>
                              <p>Un servio que el cliente pueda reser var de forma comoda.</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
                <div class="about-video-wrap" style="background-image: url('{{ asset("static/images/14-consejos-para-realizar-fotos-de-viajes-originales-1.png") }}');">
                  <div class="video-button">
                     <a id="video-container" data-video-id="IUN664s7N-c">
                        <i class="fas fa-play"></i>
                      </a>
                     </div>
                  </div>
            </div>
         </div>
         <!-- client section html start -->
         <div class="client-section">
            <div class="container">
               <div class="row">
                  <div class="col-lg-8 offset-lg-2">
                     <div class="section-heading text-center" data-aos="fade-up" data-aos-once="true">
                        <h5 class="dash-style">NUESTROS ASOCIADOS</h5>
                        <h2>PATROCINADORES Y CLIENTES</h2>
                        <p>Disfruta al máximo tus vacaciones, reservando con nosotros. Despreocúpate del estrés de buscar y reservar de hospedajes y tours, déjanos a nosotros y solo preocúpate en reservar.</p>
                     </div>
                  </div>
               </div>
               <div class="client-wrap client-slider">
                  <div class="client-item">
                     <figure>
                        <img src="{{ asset('static/images/logo7.png') }}" alt="">
                     </figure>
                  </div>
                  <div class="client-item">
                     <figure>
                        <img src="{{ asset('static/images/logo8.png') }}" alt="">
                     </figure>
                  </div>
                  <div class="client-item">
                     <figure>
                        <img src="{{ asset('static/images/logo9.png') }}" alt="">
                     </figure>
                  </div>
                  <div class="client-item">
                     <figure>
                        <img src="{{ asset('static/images/logo10.png') }}" alt="">
                     </figure>
                  </div>
                  <div class="client-item">
                     <figure>
                        <img src="{{ asset('static/images/logo11.png') }}" alt="">
                     </figure>
                  </div>
                  <div class="client-item">
                     <figure>
                        <img src="{{ asset('static/images/logo8.png') }}" alt="">
                     </figure>
                  </div>
               </div>
            </div>
         </div>
         <!-- client html end -->
         <!-- callback section html start -->
         <div class="fullwidth-callback" style="background-image: url('{{ asset("static/images/project-8.jpg") }}');">
            <div class="container">
               <div class="section-heading section-heading-white text-center">
                  <div class="row">
                     <div class="col-lg-8 offset-lg-2">
                        <h5 class="dash-style">VUELVE A LLAMAR PARA MÁS</h5>
                        <h2>Ir de viaje, Descubrir y Recurdanos</h2>
                        <p>Disfruta al máximo tus vacaciones, reservando con nosotros. Despreocúpate del estrés de buscar y reservar de hospedajes y tours, déjanos a nosotros y solo preocúpate en reservar.</p>
                     </div>
                  </div>
               </div>
               <div class="callback-counter-wrap">
                  <div class="counter-item">
                     <div class="counter-item-inner">
                        <div class="counter-icon">
                           <img src="{{ asset('static/images/icon1.png') }}" alt="">
                        </div>
                        <div class="counter-content">
                           <span class="counter-no">
                              <span class="counter">500</span>K+
                           </span>
                           <span class="counter-text">
                              Clientes
                           </span>
                        </div>
                     </div>
                  </div>
                  <div class="counter-item">
                     <div class="counter-item-inner">
                        <div class="counter-icon">
                           <img src="{{ asset('static/images/icon2.png') }}" alt="">
                        </div>
                        <div class="counter-content">
                           <span class="counter-no">
                              <span class="counter">250</span>K+
                           </span>
                           <span class="counter-text">
                              Archivo de Premios
                           </span>
                        </div>
                     </div>
                  </div>
                  <div class="counter-item">
                     <div class="counter-item-inner">
                        <div class="counter-icon">
                           <img src="{{ asset('static/images/icon3.png') }}" alt="">
                        </div>
                        <div class="counter-content">
                           <span class="counter-no">
                              <span class="counter">15</span>K+
                           </span>
                           <span class="counter-text">
                              Miembros Activos 
                           </span>
                        </div>
                     </div>
                  </div>
                  <div class="counter-item">
                     <div class="counter-item-inner">
                        <div class="counter-icon">
                           <img src="{{ asset('static/images/icon4.png') }}" alt="">
                        </div>
                        <div class="counter-content">
                           <span class="counter-no">
                              <span class="counter">10</span>K+
                           </span>
                           <span class="counter-text">
                              Destinos Turísticos
                           </span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- callback html end -->
      </section>
      <!-- about html end -->
   </main>
   
      @include('layouts.footer.footer-home')

@endsection