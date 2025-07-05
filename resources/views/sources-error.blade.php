<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  @yield('head-title')

  <!--Favicon-->
  <link rel="icon" type="image/png" href="{{ asset('static/images/favicon.png') }}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('static/adminlte3/plugins/fontawesome-free/css/all.min.css') }}">
  <!--Bootstrap-->
  <link rel="stylesheet" href="{{ asset('static/vendors/bootstrap/css/bootstrap.min.css') }}" media="all">
  <!--Custom-->
  <link rel="stylesheet" href="{{ asset('static//css/error.css') }}">

  <style>

    body{
      background:linear-gradient(rgba(0,0,0,0.25),rgba(0,0,0,0.1)),url('{{ asset("static/images/home.jpg")  }}');
      background-size:cover;
      background-repeat:no-repeat;
      background-position:center center;
      background-attachment:fixed;
    }

  </style>

</head>
<body>

  @yield('content')

</body>
</html>