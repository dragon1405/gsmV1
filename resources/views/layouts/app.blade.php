<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GSM') }}</title>

    <!-- Vue -->
    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- iconos -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">





    <!-- FullCa -->
    @yield('fullcalendar')



@yield('Testf')


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('images/GSM0.png') }}" class="Logo rounded" alt="Cinque Terre" style="width:95px;">

                    {{--  {{ config('app.name', 'GSM') }} --}}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <!--  ****************** -->
                    <ul class="navbar-nav mr-auto">

                        @can('projects.index')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('times.index') }}"><i class="far fa-file-excel"></i> Time sheet</a>
                        </li>
                        @endcan


                        <li class="nav-item dropdown">

                            @canany(['users.index','roles.index'])
                            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"><i class="fas fa-file-invoice"></i> Reporte</a>
                            @endcanany
                            <div class="dropdown-menu">

                                @can('users.index')
                                <a class="nav-link dropdown-item" href="{{ route('times.listR') }}"><i class="far fa-file-alt"></i> Mi Time sheet</a>
                                @endcan

                                 @can('users.index')
                                <a class="nav-link dropdown-item" href="{{ route('times.listAll') }}"><i class="far fa-file-alt"></i> Time sheet</a>
                                @endcan

                                <a class="nav-link dropdown-item" href=""><i class="far fa-file-alt"></i> Horas Proyectos</a>
                                <a class="nav-link dropdown-item" href=""><i class="far fa-file-alt"></i> Costos proyectos</a>
                                <a class="nav-link dropdown-item" href=""><i class="far fa-file-alt"></i> Dias especiales tomados</a>


                            </div>
                        </li>


                        @can('projects.index')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('projects.index') }}"><i class="fas fa-project-diagram"></i> Proyectos</a>
                        </li>
                        @endcan

                        @can('departments.index')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('departments.index') }}"><i class="far fa-building"></i> Departamentos</a>
                        </li>
                        @endcan


                        <li class="nav-item dropdown">

                            @canany(['users.index','roles.index'])
                            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"><i class="fas fa-cogs"></i> Configuracion</a>
                            @endcanany
                            <div class="dropdown-menu">
                                @can('users.index')
                                <a class="nav-link dropdown-item" href="{{ route('users.index') }}"><i class="fas fa-users"></i> Usuarios</a>
                                @endcan
                                @can('roles.index')
                                <a class="nav-link dropdown-item" href="{{ route('roles.index') }}"><i class="fas fa-users-cog"></i> Permisos</a>
                                @endcan
                            </div>
                        </li>

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"> <i class="fas fa-key"></i> {{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fas fa-user-circle"></i>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"><i class="fas fa-door-open"></i>
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">

        @yield('content')
    </main>
</div>

</body>
</html>
