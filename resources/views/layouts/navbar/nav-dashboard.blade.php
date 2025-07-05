<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button" title="Colocar Pantalla Completa">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('profile') }}" title="Ir Al Perfil">
        <i class="fas fa-user"></i>
      </a>
    </li>
    <li class="nav-item">
      <form action="{{ route('logout') }}" method="POST" class="nav-link" title="Logout">
        <label for="logout" style="cursor:pointer;"><i class="fas fa-sign-out-alt"></i></label>
        <input id="logout" type="submit" class="d-none">

        @csrf
      </form>
    </li>
  </ul>
</nav>
<!-- /.navbar -->