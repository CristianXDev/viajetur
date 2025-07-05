@extends('sources-error')

@section('head-title')

<title>VIAJETUR | ERROR 404</title>

@endsection

@section('content')

<div class="error-container text-white">
  <div class="error-code">404</div>
  <div class="error-message">¡Oops! No se ha podido encontrar la página :(</div>
  <a href="{{ url('/')}}" class="btn btn-outline-primary btn-back">Volver a la pagina principal</a>
</div>

@endsection