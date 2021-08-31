<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Batterry Tracking App</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Krona+One&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <link href="{{asset('fontawesome/css/all.css')}}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand navbar-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <span class='d-none d-md-block text-white'><i class='fas fa-battery'></i> Battery Tracking App</span>
                    <span class='d-block d-md-none text-primary'><i class='fas fa-battery'></i> BTA</span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mx-auto">
                        @guest

                        @else
                        <!--
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('home') }}">
                                    <span class='d-none d-md-block'>
                                        <i class='fas fa-th-list'></i> {{ __('Dashboard') }}
                                    </span>
                                    <span class='d-block d-md-none'>
                                        <i class='fas fa-th-list'></i>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link messages" href="{{ url('messages') }}">
                                    <span class='d-none d-sm-block'>
                                        <i class='fas fa-envelope'></i> {{ __('Messages') }}
                                    </span>
                                    <span class='d-block d-sm-none'>
                                        <i class='fas fa-envelope'></i>
                                    </span>
                                    <span class='badge badge-primary'>0</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('profile') }}">
                                    <span class='d-none d-sm-block'>
                                        <i class='fas fa-user'></i> {{ __('Profile') }}
                                    </span>
                                    <span class='d-block d-sm-none'>
                                        <i class='fas fa-user'></i>
                                    </span>
                                </a>
                            </li>-->
                        @endguest

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        @guest
                            <li class="nav-item">
                                <a class="btn btn-primary mr-3" href="{{ route('login') }}"><i class='fas fa-sign-in-alt'></i> {{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="btn btn-danger" href="{{ route('register') }}"><i class='fas fa-pen-fancy'></i> {{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class='nav-item'>
                                <a href='{{url("home")}}' class='btn btn-primary'>Dashboard</a>
                            </li>
                            <!--<li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Hi, {{ Auth::user()->firstname }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>-->
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>


    @if (\Session::has('success'))
        <div class="notifications bg-success shadow">
            <p class='text-white text-center'><i class='fas fa-check-circle'></i> {!! \Session::get('success') !!}</p>
        </div>
    @endif
    @if (\Session::has('error'))
        <div class="notifications bg-danger shadow">
            <p class='text-white text-center'><i class='fas fa-exclamation-circle'></i> {!! \Session::get('error') !!}</p>
        </div>
    @endif
    @if (count($errors) > 0)
        <div class="notifications bg-danger shadow">
            <ul class='text-white'>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('js')
    <script>
        $(document).ready(function(){
            setTimeout(function(){
                $('.notifications').fadeOut(1000);
            }, 3000);
        });
    </script>
</body>
</html>
