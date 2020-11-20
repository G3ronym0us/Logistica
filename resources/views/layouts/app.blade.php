<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript">
        function linkCrear(){
	window.location.href = 'http://localhost:8000' +'/detalles'
}
function linkCorrelativo(){
	window.location.href = 'http://localhost:8000' +'/correlativo'
}
function linkBeneficiario(){
	window.location.href = 'http://localhost:8000' +'/beneficiario'
}
function linkCatalogo(){
	window.location.href = 'http://localhost:8000' +'/catalogo'
}
function linkUnidad(){
	window.location.href = 'http://localhost:8000' +'/unidad_medida'
}
function linkUsuario(){
	window.location.href = 'http://localhost:8000' +'/usuario'
}
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/toastr.css') }}" rel="stylesheet">
    
</head>
<body>
    <div id="app">
    <img src="{{ asset('img/logo.png')}}" width="100%">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @if (!Auth::guest())
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="" onClick="linkCrear()">Crear Correlativo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onClick="linkCorrelativo()">Correlativos</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-cog"></i>Configuración</a>
                            <div class="dropdown-menu">
                            <a class="dropdown-item" href="#" onClick="linkBeneficiario()">Beneficiario</a>
                            <a class="dropdown-item" href="#" onClick="linkCatalogo()">Catalago</a>
                            @if(Auth::user()->rol == 'ADMINISTRADOR')
                            <a class="dropdown-item" href="#" onClick="linkUnidad()">Unidad de Medida</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" onClick="linkUsuario()">Usuarios</a>
                            </div>
                            @endif
                        </li>
                    </ul>
                    @endif
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
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
        <div>
                @yield('content')
            </div>
            
        </main>
    </div>
</body>
</html>
