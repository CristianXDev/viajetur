<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  @yield('head-title')

  <!--Favicon-->
  <link rel="icon" type="image/png" href="{{ asset('static/images/favicon.png') }}">

  <!--Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,400&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap" rel="stylesheet">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('static/adminlte3/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('static/adminlte3/dist/css/adminlte.min.css') }}">

  <!--SWEETALERT-->
  <script src="{{ asset('static/js/sweetalert.min.js') }}"></script>

</head>
<body class="hold-transition sidebar-mini">

  @include('layouts.partials.alert')

  @include('layouts.navbar.nav-dashboard')

  @include('layouts.asidebar.asidebar-dashboard')

  @yield('content')

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="{{ asset('static/adminlte3/plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap -->
  <script src="{{ asset('static/adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- AdminLTE -->
  <script src="{{ asset('static/adminlte3/dist/js/adminlte.js') }}"></script>
  <!-- OPTIONAL SCRIPTS -->
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('static/adminlte3/dist/js/demo.js') }}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{ asset('static/adminlte3/dist/js/pages/dashboard3.js') }}"></script>

  @yield('extra-scripts')
</body>
</html>
