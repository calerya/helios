<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Helios') }}</title>

    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    <!-- Iconos -->

    @yield('styles')
    

    <!-- Styles -->
    
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/flatly/bootstrap.min.css" integrity="sha384-qF/QmIAj5ZaYFAeQcrQ6bfVMAh4zZlrGwTPY7T/M+iTTLJqJBJjwwnsE5Y0mV7QK" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
   
    
</head>
<body>
    <div id="app">
     <!--   <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm"> -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        
            <div class="container-fluid">
                
                <a class="navbar-brand" href="{{ url('/') }}">
                  <img src="{{ asset('logo.png') }}" height="30" alt="Logo">
                </a>
                
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Helios') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        
                        
                        
                     
                    @if(auth()->check())    
                        @if(auth()->user()->rol==4)
                        
                        <li @if(request()->is('consultas')) class="nav-item active" @else class="nav-item" @endif>
                            <a class="nav-link" href="/consultas">Proyectos</a>
                        </li>
                        
                        
                        @endif
                        
                        
                        @if(auth()->user()->rol!=4)
                            <li @if(request()->is('buscador')) class="nav-item active" @else class="nav-item" @endif>
                            <a class="nav-link" href="/buscador">Buscar proyectos</a>
                            </li>
                        @endif
                          
                        
                        @if(auth()->user()->rol!=4)
                        
                        <li @if(request()->is('proyecto*')  
                            or (request()->is('finalizados')) or (request()->is('hitos'))) 
                            class="nav-item dropdown active" @else class="nav-item dropdown" @endif>
                            
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Proyectos</a>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="/proyectos">Alta de proyecto</a>
                              <a class="dropdown-item" href="/finalizados">Consultar finalizados</a>
                              <!--<div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="/hitos">Hitos</a> -->
                            </div>
                          </li>
                        
                        
                         <!--
                            <li @if(request()->is('proyectos*')) class="nav-item active" @else class="nav-item" @endif>
                            <a class="nav-link" href="/proyectos">Proyectos</a>
                          </li>
                        @endif
                        
                       
                        @if(auth()->user()->rol!=4)
                            <li @if(request()->is('buscador')) class="nav-item active" @else class="nav-item" @endif>
                            <a class="nav-link" href="/buscador">Buscar proyectos</a>
                            </li>
                        @endif
                        
                                    
                        @if(auth()->user()->rol!=4)
                            <li @if(request()->is('finalizados')) class="nav-item active" @else class="nav-item" @endif>
                            <a class="nav-link" href="/finalizados">Finalizados</a>
                            </li>
                        @endif  -->
                          
                        
                        @if(auth()->user()->rol!=4)
                            <li @if(request()->is('listados')) class="nav-item active" @else class="nav-item" @endif>
                            <a class="nav-link" href="/listados">Listado organismos</a>
                            </li>
                        @endif
                        
                        @if(auth()->user()->rol==1)
                                
                                <li @if(request()->is('usuario*') or (request()->is('eliminados*'))) 
                                    class="nav-item dropdown active" @else class="nav-item dropdown" @endif>
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Administrador</a>
                                    <div class="dropdown-menu">
                                      <a class="dropdown-item" href="/usuarios">Usuarios</a>
                                        <div class="dropdown-divider"></div>
                                      <a class="dropdown-item" href="/eliminados/proyectos">Proyectos eliminados</a>
                                      <a class="dropdown-item" href="/eliminados/organismos">Organismos eliminados</a>
                                      <a class="dropdown-item" href="/eliminados/usuarios">Usuarios eliminados</a>
                                    </div>
                                  </li>
                                    
                              
                            @endif
                        
                        @else
                          <li class="nav-item">
                            <a class="nav-link" href="#">Bienvenido</a>
                          </li>
                        
                        @endif
                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
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
        
        
                
                <div class="col-md-12" style="padding-top: 15px;">
                    
                    
                        @yield('content')
                  
                    
                </div>
                
            </div>
      

    
       
 

   
    
        
    {{-- <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
    
     --}}
    
{{--     
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    
     --}}
    

    <script src="https://kit.fontawesome.com/65c47391df.js" crossorigin="anonymous"></script>
    
    
    <script src="{{ asset('js/app.js') }}"></script>
    
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
    @yield('scripts')
    
    

    
</body>
</html>
