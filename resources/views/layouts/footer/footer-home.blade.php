<footer id="colophon" class="site-footer footer-primary">
   <div class="top-footer">
      <div class="container">
         <div class="row">
            <div class="col-lg-4 col-md-6">
               <aside class="widget widget_text">
                  <h3 class="widget-title">
                     Acerca de los viajes
                  </h3>
                  <div class="textwidget widget-text">
                     Esperamos que estas opciones te sean útiles para planificar tus próximas Vacaciones
                  </div>
                  <div class="award-img">
                     <a href="#"><img src="assets/images/logo6.png" alt=""></a>
                     <a href="#"><img src="assets/images/logo2.png" alt=""></a>
                  </div>
               </aside>
            </div>
            <div class="col-lg-4 col-md-6">
               <aside class="widget widget_text">
                  <h3 class="widget-title">Información de Contacto</h3>
                  <div class="textwidget widget-text">
                     Dudas sobre algún plan o información de la página contáctenos.
                     <ul>
                        <li>
                           <a href="#">
                              <i class="fas fa-phone-alt"></i>
                              +58 (0412) 3451234
                           </a>
                        </li>
                        <li>
                           <a href="#">
                              <i class="fas fa-envelope"></i>
                              ViajeTur@Gmail.com
                           </a>
                        </li>
                        <li>
                           <i class="fas fa-map-marker-alt"></i>
                           Venezuela, Edo. Aragua
                        </li>
                     </ul>
                  </div>
               </aside>
            </div>

            <div class="col-lg-4 col-md-6">
               <aside class="widget widget_newslatter">
                  <h3 class="widget-title">Suscríbete</h3>
                  <div class="widget-text">
                     Está al pendiente de la última información y ofertas para tus vacaciones
                  </div>
                       <form class="newslatter-form" action="{{ route('suscribe-mail') }}" method="POST">
                     <input type="email" name="email" placeholder="Ingresa Tu Correo..">
                     @csrf
                  </form>
               </aside>
            </div>
         </div>
      </div>
   </div>
   <div class="buttom-footer">
      <div class="container">
         <div class="row align-items-center">
            <div class="col-md-5">
               <div class="footer-menu">
                  <ul>
                     <li>
                        <a href="#">Politicas de Privacidad</a>
                     </li>
                     <li>
                        <a href="#">Términos & Condiciones</a>
                     </li>
                     <li>
                        <a href="#">FAQ</a>
                     </li>
                  </ul>
               </div>
            </div>
            <div class="col-md-2 text-center">
               <a href="{{ route('index') }}">
                  <div class="logo-nav">
                     <img src="{{ asset('static/images/favicon.png') }}" alt="logo">
                     <h1>VIAJE<span>TUR</span></h1>
                   </div>
                </a>
            </div>
            <div class="col-md-5">
               <div class="copy-right text-right">Copyright © 2023 ViajeTur. Listos para reservar</div>
            </div>
         </div>
      </div>
   </div>
</footer>
<a id="backTotop" href="#" class="to-top-icon">
   <i class="fas fa-chevron-up"></i>
</a>
<!-- custom search field html -->
<div class="header-search-form">
   <div class="container">
      <div class="header-search-container">
         <form class="search-form" role="search" method="get" >
            <input type="text" name="s" placeholder="Enter your text...">
         </form>
         <a href="#" class="search-close">
            <i class="fas fa-times"></i>
         </a>
      </div>
   </div>
</div>
<!-- header html end -->
</div>