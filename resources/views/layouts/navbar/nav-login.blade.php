<div class="bottom-header">
   <div class="container d-flex justify-content-between align-items-center">
      <div class="site-identity">
         <h1 class="site-title">
            <a href="{{ route('index') }}">
               <div class="logo-nav">
                  <img src="{{ asset('static/images/favicon.png') }}" alt="logo">
                  <h1>VIAJE<span>TUR</span></h1>
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
         @yield('nav-btn')
      </div>
   </div>
</div>
