<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 position-fixed vh-100 top-0">
  <!-- Brand Logo -->
  <a href="{{url('/dashboard')}}" class="brand-link">
    <img src="{{ asset('static/images/favicon.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light ml-4">VIAJE<span style="color:#5F4DEE;">TUR</span></span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        @if (isset(Auth()->user()->foto))
        <img src="{{ asset('storage/'.Auth()->user()->foto) }}" alt="Imagen Circular" class="img-circle elevation-2" style="height:35px ;" alt="User Image">
        @else
        <img src="{{ asset('static/images/user-img.png') }}" alt="Imagen Circular" class="img-circle elevation-2" style="height:35px ;" alt="User Image">
        @endif
      </div>
      <div class="info">
        <a href="{{ route('profile') }}" class="d-block">
          @if (Auth()->user()->nombre && Auth()->user()->apellido)
          {{Auth()->user()->nombre}} {{Auth()->user()->apellido}}
          @else
          {{Auth()->user()->email}}  
          @endif
        </a>
      </div>
    </div>

    <!-- SidebarSearch Form 
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>
  -->

  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
<!-- Add icons to the links using the .nav-icon class
  with font-awesome or any other icon font library -->

  <!--ACOUNTS-->
  <li class="nav-item menu-is-opening menu-open">
    <a href="#" class="nav-link">
      <i class="nav-icon far fa-circle text-primary"></i>
      <p>
        Mi Información
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">

      <li class="nav-item">
        <a href="{{ route('profile') }}" class="nav-link {{ request()->routeIs('profile') ||  request()->routeIs('profile-edit') ||  request()->routeIs('profile-delete') ? 'bg-purple' : '' }}">
          <i class="far fa-user nav-icon"></i>
          <p>Perfil</p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('mis_reservas') }}" class="nav-link {{ request()->routeIs('mis_reservas') ? 'bg-purple' : '' }}">
          <i class="fas fa-plane nav-icon"></i>
          <p><small>Mis paquetes reservados</small></p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('mis_reservas_hoteles') }}" class="nav-link {{ request()->routeIs('mis_reservas_hoteles') ? 'bg-purple' : '' }}">
          <i class="fas fa-hotel nav-icon"></i>
          <p><small>Mis hoteles reservados</small></p>
        </a>
      </li>

    </ul>
  </li>
  @if ( Auth()->user()->role->administrar_roles == 1 || Auth()->user()->role->administrar_usuarios == 1 || Auth()->user()->role->administrar_estados == 1 || Auth()->user()->role->administrar_municipios == 1)
  <li class="nav-item {{
    request()->routeIs('estado.index') 
    ||request()->routeIs('estado.create') 
    ||request()->routeIs('estado.edit') 
    ||request()->routeIs('role.index')  
    ||request()->routeIs('role.edit') 
    ||request()->routeIs('role.create') 
    ||request()->routeIs('usuario.index')  
    ||request()->routeIs('usuario.edit') 
    ||request()->routeIs('usuario.create')
    ||request()->routeIs('municipio.index')  
    ||request()->routeIs('municipio.edit') 
    ||request()->routeIs('municipio.create')
    ||request()->routeIs('auditorias') 
    ? 'menu-is-opening menu-open' : '' }}">

    <a href="#" class="nav-link">
      <i class="nav-icon far fa-circle text-red"></i>
      <p>
        Sistema
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">

      @if (Auth()->user()->role->administrar_roles == 1)
      <li class="nav-item">
        <a href="{{ url('/role') }}" class="nav-link {{ request()->routeIs('role.index') || request()->routeIs('role.edit') || request()->routeIs('role.create') ? 'bg-purple' : '' }}">
          <i class="nav-icon fas fa-user-tag"></i>
          <p>
            Roles
          </p>
        </a>
      </li>
      @endif
      
      @if (Auth()->user()->role->administrar_estados == 1)
      <li class="nav-item">
        <a href="{{ url('/estado') }}" class="nav-link {{ request()->routeIs('estado.index') || request()->routeIs('estado.create') || request()->routeIs('estado.edit') ? 'bg-purple' : '' }}">
          <i class="nav-icon fas fa-map-marker-alt"></i>
          <p>
            Estados
          </p>
        </a>
      </li>
      @endif
      
      @if (Auth()->user()->role->administrar_usuarios == 1)
      <li class="nav-item">
        <a href="{{ url('/usuario') }}" class="nav-link {{ request()->routeIs('usuario.index')? 'bg-purple' : '' }}">
          <i class="nav-icon fas fa-users"></i>
          <p>
            Administrar Usuarios
          </p>
        </a>
      </li>
      @endif

      @if (Auth()->user()->role->administrar_municipios == 1)
      <li class="nav-item">
        <a href="{{ url('/municipio') }}" class="nav-link {{ request()->routeIs('municipio.index') || request()->routeIs('municipio.create') || request()->routeIs('municipio.edit') ? 'bg-purple' : '' }}">
          <i class="nav-icon fas fa-building"></i>
          <p>
            Munipios
          </p>
        </a>
      </li>
      @endif

      @if (Auth()->user()->role->id == 1)
      <li class="nav-item">
        <a href="{{ route('auditorias') }}" class="nav-link {{ request()->routeIs('auditorias') ? 'bg-purple' : '' }}">
          <i class="nav-icon fas fa-balance-scale"></i>
          <p>
            Auditorias
          </p>
        </a>
      </li>
      @endif
    </ul>
  </li>
  @endif
  <!--SERVICE-->
  <li class="nav-item {{request()->routeIs('destino.index') 
    ||request()->routeIs('destino.create') 
    ||request()->routeIs('destino.edit') 
    ||request()->routeIs('hotel.index') 
    ||request()->routeIs('hotel.create') 
    ||request()->routeIs('hotel.edit')  ? 'menu-is-opening menu-open' : '' }}">

    <a href="#" class="nav-link">
      <i class="nav-icon far fa-circle text-warning"></i>
      <p>
        Servicios
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ url('/destino') }}" class="nav-link {{ request()->routeIs('destino.index') || request()->routeIs('destino.create') || request()->routeIs('destino.edit') ? 'bg-purple' : '' }}">
          <i class="nav-icon fas fa-map-marker-alt"></i>
          <p>
            Destino
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ url('/hotel') }}" class="nav-link {{ request()->routeIs('hotel.index') || request()->routeIs('hotel.create') || request()->routeIs('hotel.edit') ? 'bg-purple' : '' }}">
          <i class="nav-icon fas fa-hotel"></i>
          <p>
            Hotel
          </p>
        </a>
      </li>

    </ul>
  </li>

    <!--SISTEMA 
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon far fa-circle text-orange"></i>
        <p>
          Sistema
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>

      <ul class="nav nav-treeview">

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-tag"></i>
            <p>
              Roles
            </p>
          </a>
        </li>

      </ul>
    </li>
  -->

  <!--PAQUETES-->
  <li class="nav-item {{ request()->routeIs('paquete.index') ||
    request()->routeIs('paquete.create') ||
    request()->routeIs('paquete.edit') ? 'menu-is-opening menu-open' : '' }}">
    <a href="#" class="nav-link">
      <i class="nav-icon far fa-circle text-info"></i>
      <p>
        Paquetes turisticos
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">

      <li class="nav-item">
        <a href="{{ url('/paquete') }}" class="nav-link
        {{ request()->routeIs('paquete.index')
        || request()->routeIs('paquete.create')
        || request()->routeIs('paquete.edit') ? 'bg-purple' : '' }}">
        <i class="nav-icon fas fa-hiking"></i>
        <p>
          Disponibles
        </p>
      </a>
    </li>

    <li class="nav-item">
      <a href="{{ url('/destacados') }}" class="nav-link
      {{ request()->routeIs('destacados.index') ? 'bg-purple' : '' }}">
      <i class="nav-icon fas fa-heart"></i>
      <p>
        Destacados
      </p>
    </a>
  </li>
</ul>
</li>


@if ( Auth()->user()->role->administrar_roles == 1 || Auth()->user()->role->administrar_usuarios == 1)
<li class="nav-item {{
  request()->routeIs('reporte_usuario') 
  ||request()->routeIs('reporte_paquete') 
  ||request()->routeIs('reporte_hotel') 
  ||request()->routeIs('reporte_destino')  
  ? 'menu-is-opening menu-open' : '' }}">

  <a href="#" class="nav-link">
    <i class="nav-icon far fa-circle text-success"></i>
    <p>
      Reportes
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">

    @if (Auth()->user()->role->administrar_roles == 1)
    <li class="nav-item">
      <a href="{{ url('/dashboard/reporte/usuario') }}" class="nav-link {{ request()->routeIs('reporte_usuario') ? 'bg-purple' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>
          Usuarios
        </p>
      </a>
    </li>
    @endif

    @if (Auth()->user()->role->administrar_estados == 1)
    <li class="nav-item">
      <a href="{{ url('/dashboard/reporte/paquete') }}" class="nav-link {{ request()->routeIs('reporte_paquete') ? 'bg-purple' : '' }}">
        <i class="nav-icon fas fa-cube"></i>
        <p>
          Paquetes
        </p>
      </a>
    </li>
    @endif

    @if (Auth()->user()->role->administrar_usuarios == 1)
    <li class="nav-item">
      <a href="{{ url('/dashboard/reporte/hotel') }}" class="nav-link {{ request()->routeIs('reporte_hotel')? 'bg-purple' : '' }}">
        <i class="nav-icon fas fa-hotel"></i>
        <p>
         Hoteles
       </p>
     </a>
   </li>
   @endif

   @if (Auth()->user()->role->administrar_municipios == 1)
   <li class="nav-item">
    <a href="{{ url('/dashboard/reporte/destino') }}" class="nav-link {{ request()->routeIs('reporte_destino') ? 'bg-purple' : '' }}">
      <i class="nav-icon fas fa-map-marker-alt"></i>
      <p>
        Destinos
      </p>
    </a>
  </li>
  @endif
</ul>
</li>
@endif

@if ( Auth()->user()->role->administrar_roles == 1 || Auth()->user()->role->administrar_usuarios == 1)
<li class="nav-item {{
  request()->routeIs('estadisticas_paquete') 
  ||request()->routeIs('estadisticas_hotel') 
  ||request()->routeIs('estadisticas_destino') 
  ||request()->routeIs('estadisticas_usuario')  
  ? 'menu-is-opening menu-open' : '' }}">

  <a href="#" class="nav-link">
    <i class="nav-icon far fa-circle text-purple"></i>
    <p>
      Estadisticas
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">

    @if (Auth()->user()->role->administrar_roles == 1)
    <li class="nav-item">
      <a href="{{ route('estadisticas_usuario') }}" class="nav-link {{ request()->routeIs('estadisticas_usuario') ? 'bg-purple' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>
          Usuarios
        </p>
      </a>
    </li>
    @endif

    <li class="nav-item">
      <a href="{{ route('estadisticas_paquete') }}" class="nav-link {{ request()->routeIs('estadisticas_paquete') ? 'bg-purple' : '' }}">
        <i class="nav-icon fas fa-cube"></i>
        <p>
          Paquetes
        </p>
      </a>
    </li>

    <li class="nav-item">
      <a href="{{ route('estadisticas_destino') }}" class="nav-link {{ request()->routeIs('estadisticas_destino') ? 'bg-purple' : '' }}">
        <i class="nav-icon fas fa-map-marker-alt"></i>
        <p>
          Destinos
        </p>
      </a>
    </li>

    <li class="nav-item">
      <a href="{{ route('estadisticas_hotel') }}" class="nav-link {{ request()->routeIs('estadisticas_hotel') ? 'bg-purple' : '' }}">
        <i class="nav-icon fas fa-hotel"></i>
        <p>
          Hotel
        </p>
      </a>
    </li>

<!--
    @if (Auth()->user()->role->administrar_usuarios == 1)
    <li class="nav-item">
      <a href="{{ route('estadisticas_hotel') }}" class="nav-link {{ request()->routeIs('estadisticas_hotel')? 'bg-purple' : '' }}">
        <i class="nav-icon fas fa-hotel"></i>
        <p>
         Hoteles
       </p>
     </a>
   </li>
   @endif
 -->
</ul>
</li>
@endif

  <!--STATS
  <li class="nav-item">
    <a href="#" class="nav-link">
      <i class="nav-icon far fa-circle text-success"></i>
      <p>
        Estadisticas
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
  </li>
-->

</ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>