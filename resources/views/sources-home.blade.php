   <!DOCTYPE html>
   <html lang="es">
   <head>

      <!--==STYLESHEET==-->

      <!--Required Meta Tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- Favicon -->
      <link rel="icon" type="image/png" href="{{ asset('static/images/favicon.png') }}">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="{{ asset('static/vendors/bootstrap/css/bootstrap.min.css') }}" media="all">
      <!-- Fonts Awesome CSS -->
      <link rel="stylesheet" type="text/css" href="{{ asset('static/vendors/fontawesome/css/all.min.css') }}" >
      <!-- JQUERY-UI CSS -->
      <link rel="stylesheet" type="text/css" href="{{ asset('static/vendors/jquery-ui/jquery-ui.min.css') }}">
      <!-- Modal Video CSS -->
      <link rel="stylesheet" type="text/css" href="{{ asset('static/vendors/modal-video/modal-video.min.css') }}">
      <!-- Light Box CSS-->
      <link rel="stylesheet" type="text/css" href="{{ asset('static/vendors/lightbox/dist/css/lightbox.min.css') }}">
      <!-- Slick Slider CSS -->
      <link rel="stylesheet" type="text/css" href="{{ asset('static/vendors/slick/slick.css') }}">
      <!--Favicon-->
      <link rel="icon" type="image/png" href="{{ asset('static/images/favicon.png') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('static/vendors/slick/slick-theme.css') }}">
      <!-- AOS CSS-->
      <link rel="stylesheet" type="text/css" href="{{ asset('static/css/aos.css') }}">
      <!-- Google Fonts -->
      <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,400&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap" rel="stylesheet">

      <!-- Custom CSS -->
      <link rel="stylesheet" type="text/css" href="{{ asset('static/css/style.css') }}">

      @yield('head-title')

      @yield('content-home')

      <!--==JS==-->
      <script src="{{ asset('static/js/jquery.js') }}"></script>
      <script src="{{ asset('static/js/aos.js') }}"></script>
      <script src="{{ asset('static/http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js') }}"></script>
      <script src="{{ asset('static/vendors/bootstrap/js/bootstrap.min.js') }}"></script>
      <script src="{{ asset('static/vendors/jquery-ui/jquery-ui.min.js') }}"></script>
      <script src="{{ asset('static/vendors/countdown-date-loop-counter/loopcounter.js') }}"></script>
      <script src="{{ asset('static/js/jquery.counterup.js') }}"></script>
      <script src="{{ asset('static/vendors/modal-video/jquery-modal-video.min.js') }}"></script>
      <script src="{{ asset('static/vendors/masonry/masonry.pkgd.min.js') }}"></script>
      <script src="{{ asset('static/vendors/lightbox/dist/js/lightbox.min.js') }}"></script>
      <script src="{{ asset('static/vendors/slick/slick.min.js') }}"></script>
      <script src="{{ asset('static/js/jquery.slicknav.js') }}"></script>
      <script src="{{ asset('static/js/custom.min.js') }}"></script>
      <script src="{{ asset('static/js/text-change.js') }}"></script>

      <!--AOS-->
      <script>
      AOS.init({
          duration:1600
       });

      </script>

   </body>
   </html>