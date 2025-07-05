<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @yield('head-title')

    <!--==STYLESHEET==-->

    <!--Favicon-->
    <link rel="icon" type="image/png" href="{{ asset('static/images/favicon.png') }}">
    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="{{ asset('static/vendors/bootstrap/css/bootstrap.min.css') }}" media="all">
    <!--Fonts Awesome CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('static/vendors/fontawesome/css/all.min.css') }}" >
    <!--AOS CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('static/css/aos.css') }}">
    <!--Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,400&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap" rel="stylesheet">
    <!--Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('static/css/style.css') }}">
    <!--Form CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('static/css/form.css') }}">
    <!--SWEETALERT-->
    <script src="{{ asset('static/js/sweetalert.min.js') }}"></script>

    <!--STYLE-->
    <style>

        body{
            background:linear-gradient(rgba(0,0,0,0.25),rgba(0,0,0,0.1)),url('{{ asset("static/images/form-bg-1.jpg")  }}');
            background-size:cover;
            background-repeat:no-repeat;
            background-position:center center;
            background-attachment:fixed;
        }

    </style>

</head>
<body>

    @include('layouts.partials.alert')

    <!--Incluye el archivo que contiene la barra de navegacion-->
    @include('layouts.navbar.nav-login')

    <div class="form-description" data-aos="fade-right" data-aos-once="true">

        <h1>¿NECESITAS AYUDA?</h1>
        <p>¡Si tienes algún problema al iniciar sesión o registrandote en nuestra plataforma, puedes hacer click en el botón que está abajo para ayudarte a acceder al sistema y así puedas disfrutar de los mejores paquetes turisticos!</p>

        <div class="help-button">
            <input type="submit" class="" value="¡NECESITO AYUDA!" data-toggle="modal" data-target="#helpModal">
        </div>
    </div>


    <!--MODAL-->
    <div class="modal" id="helpModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-question-circle"></i> Ayuda y recomendaciones</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center">

                    <h3><strong>¿Problemas al registrarte/iniciar sesión?</strong></h3>
                    <p>Recuerda que puedes dar click sobre el icono al lado de cada campo del formulario, al clickear desplegará un menú de ayuda para que puedas identificar si estas cometiendo algún error al escribir o puedas identificar rapidamente que caracteres son admitidos y cuales no.</p>

                    <img src="{{ asset('static/images/help_login.png') }}" class="img-fluid mb-5">

                </div>
            </div>
        </div>
    </div>

                @yield('content')

                <!--==JS ==-->
                <script src="{{ asset('static/js/jquery.js') }}"></script>
                <script src="{{ asset('static/vendors/jquery-ui/jquery-ui.min.js') }}"></script>
                <script src="{{ asset('static/js/jquery.counterup.js') }}"></script>
                <script src="{{ asset('static/js/jquery.slicknav.js') }}"></script>
                <script src="{{ asset('static/vendors/bootstrap/js/bootstrap.min.js') }}"></script>
                <script src="{{ asset('static/js/form.js') }}"></script>
                <script src="{{ asset('static/js/aos.js') }}"></script>

                <!--AOS-->
                <script>
                    AOS.init({
                        duration:1400
                    });
                </script>

                <script>

                </script>

            </body>
            </html>