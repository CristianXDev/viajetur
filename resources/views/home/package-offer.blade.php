@extends('sources-home')

@section('head-title')

<title>VIAJETUR | PAQUETES EN OFERTAS</title>

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
               <div class="inner-baner-container" style="background-image: url('{{ asset("static/images/photo-1551632811-561732d1e306.jpeg") }}') ; ">
                  <div class="container">
                     <div class="inner-banner-content">
                        <h1 class="inner-title">Paquetes En Oferta</h1>
                     </div>
                  </div>
               </div>
               <div class="inner-shape"></div>
            </section>
            <!-- Inner Banner html end-->
            <section class="package-offer-wrap">
               <!-- special section html start -->
               <div class="special-section">
                  <div class="container">
                     <div class="special-inner">
                        <div class="row">
                           <div class="col-md-6 col-lg-4">
                              <div class="special-item">
                                 <figure class="special-img">
                                    <img src="{{ asset('static/images/project-7.jpg') }}" alt="">
                                 </figure>
                                 <div class="badge-dis">
                                    <span>
                                       <strong>20%</strong>
                                       menos
                                    </span>
                                 </div>
                                 <div class="special-content">
                                    <div class="meta-cat">
                                       <a href="#">China</a>
                                    </div>
                                    <h3>
                                       <a href="#">Experiencia unica en la naturaleza</a>
                                    </h3>
                                    <div class="package-price">
                                       Precio:
                                       <del>$1500</del>
                                       <ins>$1200</ins>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6 col-lg-4">
                              <div class="special-item">
                                 <figure class="special-img">
                                    <img src="{{ asset('static/images/project-8.jpg') }}" alt="">
                                 </figure>
                                 <div class="badge-dis">
                                    <span>
                                       <strong>15%</strong>
                                       menos
                                    </span>
                                 </div>
                                 <div class="special-content">
                                    <div class="meta-cat">
                                       <a href="#">Japón</a>
                                    </div>
                                    <h3>
                                       <a href="#">Viaja a un campamento en las montañas</a>
                                    </h3>
                                    <div class="package-price">
                                       Precio:
                                       <del>$1300</del>
                                       <ins>$1105</ins>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6 col-lg-4">
                              <div class="special-item">
                                 <figure class="special-img">
                                    <img src="{{ asset('static/images/project-3.jpg') }}" alt="">
                                 </figure>
                                 <div class="badge-dis">
                                    <span>
                                       <strong>15%</strong>
                                       menos
                                    </span>
                                 </div>
                                 <div class="special-content">
                                    <div class="meta-cat">
                                       <a href="#">AUSTRALIA</a>
                                    </div>
                                    <h3>
                                       <a href="#">Ve los hermosos atardeceres</a>
                                    </h3>
                                    <div class="package-price">
                                       Precio:
                                       <del>$1800</del>
                                       <ins>$1476</ins>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6 col-lg-4">
                              <div class="special-item">
                                 <figure class="special-img">
                                    <img src="{{ asset('static/images/project-4.jpg') }}" alt="">
                                 </figure>
                                 <div class="badge-dis">
                                    <span>
                                       <strong>15%</strong>
                                       menos
                                    </span>
                                 </div>
                                 <div class="special-content">
                                    <div class="meta-cat">
                                       <a href="#">ALASKA</a>
                                    </div>
                                    <h3>
                                       <a href="#">Un viaje por la montañosa región</a>
                                    </h3>
                                    <div class="package-price">
                                       Precio:
                                       <del>$1200</del>
                                       <ins>$1068</ins>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6 col-lg-4">
                              <div class="special-item">
                                 <figure class="special-img">
                                    <img src="{{ asset('static/images/project-2.jpg') }}" alt="">
                                 </figure>
                                 <div class="badge-dis">
                                    <span>
                                       <strong>15%</strong>
                                       menos
                                    </span>
                                 </div>
                                 <div class="special-content">
                                    <div class="meta-cat">
                                       <a href="#">Cuba</a>
                                    </div>
                                    <h3>
                                       <a href="#">Hermona región con increible gastronomia</a>
                                    </h3>
                                    <div class="package-price">
                                       Precio:
                                       <del>$1099</del>
                                       <ins>$956</ins>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6 col-lg-4">
                              <div class="special-item">
                                 <figure class="special-img">
                                    <img src="{{ asset('static/images/project-5.jpg') }}" alt="">
                                 </figure>
                                 <div class="badge-dis">
                                    <span>
                                       <strong>15%</strong>
                                       menos
                                    </span>
                                 </div>
                                 <div class="special-content">
                                    <div class="meta-cat">
                                       <a href="#">TAILANDIA</a>
                                    </div>
                                    <h3>
                                       <a href="#">Descubre las exótica biodiversidad de la región</a>
                                    </h3>
                                    <div class="package-price">
                                       Precio:
                                       <del>$1300</del>
                                       <ins>$1079</ins>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- special html end -->
               <div class="contact-section">
                  <div class="container">
                     <div class="row">
                        <div class="col-lg-4">
                           <div class="contact-img" style="background-image: url('{{ asset("static/images/247.png") }}');">
                           </div>
                        </div>
                        <div class="col-lg-8">
                           <div class="contact-details-wrap">
                              <div class="row">
                                 <div class="col-sm-4">
                                    <div class="contact-details">
                                       <div class="contact-icon">
                                          <img src="{{ asset('static/images/icon12.png') }}" alt="">
                                       </div>
                                       <ul>
                                          <li>
                                             <a href="#">soporte@gmail.com</a>
                                          </li>
                                          <li>
                                             <a href="#">info@gmail.com</a>
                                          </li>
                                          <li>
                                             <a href="#">viajetur@gmail.com</a>
                                          </li>
                                       </ul>
                                    </div>
                                 </div>
                                 <div class="col-sm-4">
                                    <div class="contact-details">
                                       <div class="contact-icon">
                                          <img src="{{ asset('static/images/icon13.png') }}" alt="">
                                       </div>
                                       <ul>
                                          <li>
                                             <a href="#">+58 (0412) 254 669</a>
                                          </li>
                                          <li>
                                             <a href="#">+58 (0412) 255 587</a>
                                          </li>
                                          <li>
                                             <a href="#">+58 (0412) 2599 12</a>
                                          </li>
                                       </ul>
                                    </div>
                                 </div>
                                 <div class="col-sm-4">
                                    <div class="contact-details">
                                       <div class="contact-icon">
                                          <img src="{{ asset('static/images/icon14.png') }}" alt="">
                                       </div>
                                       <ul>
                                          <li>
                                             Avenida Bolívar
                                          </li>
                                          <li>
                                             Edificio "El Sol"
                                          </li>
                                          <li>
                                             Local 101
                                          </li>
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="contact-btn-wrap">
                              <h3>SIGUENOS PARA MANTENERTE ACTUALIZADO</h3>
                              <a href="#" class="button-primary">LEER MÁS</a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
         </main>
      @include('layouts.footer.footer-home')

   @endsection