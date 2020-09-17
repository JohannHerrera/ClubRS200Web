<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- inject:js -->
        <script src="{{ asset('js/main.js') }}"></script>

        <!-- plugins:css -->
        <link rel="stylesheet" href="{{ asset('/vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/vendors/css/vendor.bundle.base.css') }}">
        <link rel="stylesheet" href="{{ asset('/vendors/css/vendor.bundle.addons.css') }}">
        <!-- endinject -->
        <!-- plugin css for this page -->
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
        <!-- endinject -->
        <link rel="shortcut icon" href="{{ asset('/images/LogoClubRS200.png') }}">
        @toastr_css

    </head>

    <body>

        <div class="container-scroller">
            <!-- partial:../../partials/_navbar.html -->
            <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
                <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
                    <a
                        class="navbar-brand brand-logo"
                        href="{{ route('home') }}"
                    >
                        <img
                            src="../../images/logo.svg"
                            alt="logo"
                        >
                    </a>
                    <a
                        class="navbar-brand brand-logo-mini"
                        href="{{ route('home') }}"
                    >
                        <img
                            src="../../images/logo-mini.svg"
                            alt="logo"
                        >
                    </a>
                </div>
                <div class="navbar-menu-wrapper d-flex align-items-center">
                    <ul class="navbar-nav navbar-nav-right">

                            @guest
                            @else

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">Inicio</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('likes') }}">Mis Favoritas</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.index') }}">Gentes</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('image.create') }}">Publicar imágen</a>
                            </li>
                            @endguest


                        <li class="nav-item dropdown d-none d-xl-inline-block">





                            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                                <!-- <span class="profile-text">
                                    @if (isset(Auth::user()->name))
                                        {{ Auth::user()->name.' '.Auth::user()->surname.' (@'.Auth::user()->nick.')' }}
                                    @endif
                                </span> -->
                                @include('includes.avatar')
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                                @if (isset(Auth::user()->isactive) && Auth::user()->isactive)
                                    <a class="dropdown-item mt-2" href="{{ route('perfil') }}">Mi Pérfil</a>

                                    <a class="dropdown-item" href="{{ route('contrasena') }}">Cambiar Contraseña</a>
                                @endif

                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                    <button
                        class="navbar-toggler navbar-toggler-right d-lg-none align-self-center"
                        type="button"
                        data-toggle="offcanvas"
                    >
                        <span class="mdi mdi-menu"></span>
                    </button>
                </div>
            </nav>
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                <!-- partial:../../partials/_sidebar.html -->

                <nav class="sidebar sidebar-offcanvas" id="sidebar">
                    <ul class="nav">
                        <li class="nav-item nav-profile">
                            <div class="nav-link">
                                <div class="user-wrapper">
                                    @if (!empty(Auth::user()->image) && Auth::user()->image != '--')
                                    <div class="profile-image">
                                        <img src="{{ route('user.avatar', ['filename'=>Auth::user()->image]) }}" alt="Avatar">
                                    </div>
                                    @endif
                                    @if (isset(Auth::user()->name))
                                    <div class="text-wrapper">
                                        <p class="profile-name">{{ Auth::user()->name.' '.Auth::user()->surname }}</p>
                                        <div>
                                            <small class="designation text-muted">{{ '(@'.Auth::user()->nick.')' }}</small>
                                            <span class="status-indicator online"></span>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </li>

                        <!--Se debe incluir el menu-->
                        <nav class="sidebar sidebar-offcanvas" id="sidebar">
                            <ul class="nav">
                                @if (isset(Auth::user()->isactive) && Auth::user()->isactive)

                                    @if (Auth::user()->roles->isadmin)
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="collapse" href="#ui-administrativo" aria-expanded="false" aria-controls="ui-administrativo">
                                                <i class="menu-icon mdi mdi-content-copy"></i>
                                                <span class="menu-title">Administrativo</span>
                                                <i class="menu-arrow"></i>
                                            </a>
                                            <div class="collapse" id="ui-administrativo">
                                                <ul class="nav flex-column sub-menu">
                                                    <li class="nav-item">
                                                        <a href="{{ route('user.crear') }}" class="nav-link">Creación de Usuarios</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>

                                        <li class="nav-item">
                                                <a class="nav-link" data-toggle="collapse" href="#ui-pilotos" aria-expanded="false" aria-controls="ui-pilotos">
                                                    <i class="menu-icon mdi mdi-account"></i>
                                                    <span class="menu-title">Pilotos</span>
                                                    <i class="menu-arrow"></i>
                                                </a>
                                                <div class="collapse" id="ui-pilotos">
                                                    <ul class="nav flex-column sub-menu">
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="{{ route('pilotos.index') }}">Gestión Pilotos</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                        </li>
                                    @endif

                                    @if (Auth::user()->roles->isadmin || Auth::user()->roles->id==4)
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="collapse" href="#ui-convenios" aria-expanded="false" aria-controls="ui-convenios">
                                                <i class="menu-icon mdi mdi-home-account"></i>
                                                <span class="menu-title">Convenios</span>
                                                <i class="menu-arrow"></i>
                                            </a>
                                            <div class="collapse" id="ui-convenios">
                                                @if (Auth::user()->roles->isadmin)
                                                <ul class="nav flex-column sub-menu">
                                                    <li class="nav-item">
                                                        <a href="{{ route('agreement.index') }}" class="nav-link">Gestión Convenios</a>
                                                    </li>
                                                </ul>
                                                @endif
                                                <ul class="nav flex-column sub-menu">
                                                    <li class="nav-item">
                                                        <a href="{{ route('agreement.buscar') }}" class="nav-link">Consultar Pilotos</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    @endif



                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                                            <i class="menu-icon mdi mdi-restart"></i>
                                            <span class="menu-title">Configuración</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                        <div class="collapse" id="auth">
                                            <ul class="nav flex-column sub-menu">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ route('perfil') }}"> Mi Pérfil </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ route('contrasena') }}">Cambiar Contraseña</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="" ></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                @endif
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="collapse" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        <i class="menu-icon mdi mdi-backup-restore"></i>
                                        <span class="menu-title">Cerrar Sesión</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </ul>
                </nav>

                <!-- partial -->
                <div class="main-panel">
                    <main class="content-wrapper">
                        @yield('content')
                    </main>

                    <!-- content-wrapper ends -->
                    <!-- partial:../../partials/_footer.html -->
                    <footer class="footer">
                        <div class="container-fluid clearfix">
                            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">
                                copyright © 2020 UDC - Todos los derechos reservados.
                            </span>
                            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
                                <!--Hand-crafted & made with-->
                                <!--i class="mdi mdi-heart text-danger"></i-->
                            </span>
                        </div>
                    </footer>
                    <!-- partial -->
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>

        <script src="{{ asset('/vendors/js/vendor.bundle.base.js') }}"></script>
        <script src="{{ asset('/vendors/js/vendor.bundle.addons.js') }}"></script>
        <!-- endinject -->
        <!-- inject:js -->
        <script src="{{ asset('/js/off-canvas.js') }}"></script>
        <script src="{{ asset('/js/misc.js') }}"></script>
        <!-- endinject -->



        @jquery
        @toastr_js
        @toastr_render

    </body>

</html>
