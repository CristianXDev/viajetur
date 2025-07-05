<!-- header html start -->
<div class="top-header">
   <div class="container">
      <div class="row">
         <div class="col-lg-8 d-none d-lg-block">
            <div class="header-contact-info">
               <ul>
                  <li>
                     <a href="#"><i class="fas fa-phone-alt"></i> +58 (0412) 3451234</a>
                  </li>
                  <li>
                     <a href="mailto:info@Travel.com"><i class="fas fa-envelope"></i> ViajeTur@Gmail.com</a>
                  </li>
                  <li>
                     <i class="fas fa-map-marker-alt"></i> Venezuela, Edo. Aragua
                  </li>
               </ul>
            </div>
         </div>
         <div class="col-lg-4 d-flex justify-content-lg-end justify-content-between">
            <div class="header-social social-links">
               <ul>
                  <li><a href="#"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                  <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                  <li><a href="#"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                  <li><a href="#"><i class="fab fa-linkedin" aria-hidden="true"></i></a></li>
               </ul>
            </div>
            <div class="header-search-icon">
               <button class="search-icon">
                  <i class="fas fa-search"></i>
               </button>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="bottom-header">
   <div class="container d-flex justify-content-between align-items-center">
      <div class="site-identity">
         <h1 class="site-title">
            <a href="{{ route('index') }}">
               <div class="logo-nav">
                  <img src="{{ asset('static/images/favicon.png') }}" alt="logo">
                  <h1 class="color-changing-element">VIAJE<span>TUR</span></h1>
                </div>
            </a>
         </h1>
      </div>
      <div class="main-navigation d-none d-lg-block">
         <nav id="navigation" class="navigation">
            <ul>
               <li class="menu">
                  <a href="{{ route('index') }}">Inicio</a>
               </li>
               <li class="menu-item-has-children">
                  <a href="#">Opciones de viajes</a>
                  <ul>
                     <li>
                        <a href="{{ route('destination') }}">Destinos</a>
                     </li>
                     <li>
                        <a href="{{ route('tour') }}">Paquetes turísticos</a>
                     </li>
                  </ul>
               </li>
               <li>
                  <a href="{{ route('service') }}">Servicios</a>
               </li>
               <li>
                  <a href="{{ route('about') }}">Acerca de </a>
               </li>
            </ul>
         </nav>
      </div>
      <div class="header-btn">
         @auth
            @if (Auth()->user()->nombre && Auth()->user()->apellido)
               <a href="{{route('dashboard')}}" class="button-primary bold">{{Auth()->user()->nombre}} {{Auth()->user()->apellido}}</a>
            @else
               <a href="{{route('dashboard')}}" class="button-primary bold">{{Auth()->user()->usuario}}</a>
            @endif
         @else     
            <a href="{{route('register')}}" class="button-primary bold">¡Registrate!</a>
         @endauth
      </div>
   </div>
</div>

