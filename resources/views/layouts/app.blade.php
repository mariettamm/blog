<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{-- esto es lo que le cambia el nombre al blog --}}
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><a href="{{ route('blog') }}">Blog</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        {{-- si eres un invitado muestra el botón de login y registroo --}}
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        {{-- de lo contrario muestra el nombre de usuario --}}
                        @else
                        {{-- creamos 3 links más --}}
                            <li><a href="{{ route('tags.index') }}">Etiquetas</a></li>
                            <li><a href="{{ route('categories.index') }}">Categorías</a></li>
                            <li><a href="{{ route('posts.index') }}">Entradas</a></li>                            

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        {{-- Programamos la alerta para que salga el mensaje informativo
        cuando una etiqueta, categoría etc se actualiza o borra con exito --}}
    @if (session('info')) 
    {{-- SI tenemos una variable de sesión llamada info --}}
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="alert alert-success"> 
                        {{-- ^ clase "alert" y clase de exito --}}
                        {{ session('info') }}
                        {{-- ^ aquí aparece el texto que debería aparecer 
                        en esta variable de sesion
                        llamamos a la variables de sesion --}}

                        {{-- Esta es además referica como una variable 
                        de sesión "flash",
                        porque si refrescamos la página, el mensaje 
                        (la variable) desaparecerá --}}
                    </div>
                </div>
            </div>
        </div>
    @endif
        {{-- alerta de errores --}}
        @if(count($errors)) 
        {{-- "si CONTAMOS la variable global $errors" 
        = si tenemos al menos un error dentro de 
        esta variable,     
        entonces vamos a mostrarlos a través del código
        a continuación   --}}
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="alert alert-danger">
                        {{-- la alerta aquí es danger para que el color
                            de la alerta cambie de verde a rojo --}}
                        <ul>
                            @foreach($errors->all() as $error)
                            {{-- este foreach recorre todo lo que tengamos
                            en errores --}}
                            <li>{{ $error }}</li>
                            {{-- dentro del li imprimimos cada mensaje
                            de error que tengamos --}}
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
    @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
