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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('css')
    <style>
        #header-nav {
            background-color: #fff;
            font-size: 16px;
            font-weight: bold;
        }

        .nav-admin {
            min-height: calc(100vh - 60px);
            height: 100%;
        }

    </style>
</head>
<body>
<div id="app">
    <nav id="header-nav" class="navbar navbar-expand-md navbar-light shadow-sm">
        <div class="container-fluid">
            {{--            <div class="row">--}}
            <a class="navbar-brand" href="{{ url('/') }}">
                {{--                    {{ config('app.name', 'Laravel') }}--}}
                <img width="" height="55" src="{{ asset('images/dcms_logo1.png') }}" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest

                        @if (Route::has('login'))
                            <li hidden class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li hidden class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
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
                        </li>
                    @endguest

                    @if(Auth::guard('staff')->user())
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::guard('staff')->user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item"
                                   href="{{ asset('staff/profile/'. Auth::guard('staff')->user()->id) }}">Profile</a>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        {{--                        @elseif(Auth::guard('patient')->check())--}}
                        {{--                            <li class="nav-item dropdown">--}}
                        {{--                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"--}}
                        {{--                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
                        {{--                                    {{ Auth::guard('patient')->user()->name }}--}}
                        {{--                                </a>--}}

                        {{--                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">--}}
                        {{--                                    <a class="dropdown-item" href="{{ route('logout') }}"--}}
                        {{--                                       onclick="event.preventDefault();--}}
                        {{--                                                     document.getElementById('logout-form').submit();">--}}
                        {{--                                        {{ __('Logout') }}--}}
                        {{--                                    </a>--}}

                        {{--                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
                        {{--                                        @csrf--}}
                        {{--                                    </form>--}}
                        {{--                                </div>--}}
                        {{--                            </li>--}}
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Login
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('patient.login') }}">Login Patient</a>
                                <a class="dropdown-item" href="{{ route('staff.login') }}">Login Staff</a>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </div>

    </nav>


    <div class="row">
        <div class="col-md-2 pr-0">
            <nav class="nav-admin">
                <p class="">Main</p>
                <ul>
                    <li><a href="{{ route('staff.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('staff.appointments') }}">Appointments</a></li>
                    <li><a href="{{ route('admin.doctors') }}">Doctors</a></li>
                    <li><a href="{{ route('admin.receptionists') }}">Receptionist</a></li>
                    <li><a href="{{ route('staff.patients') }}">Patients</a></li>
                </ul>
            </nav>
        </div>


        <div class="col-md-10">
            <div class="container-fluid">

                <div class="page-header">
                    <div class="row my-4">
                        <div class="col-md-12">
                            <h3 class="page-title">{{ $page_title }}</h3>
                            {{--                            <ul class="breadcrumb p-0">--}}
                            {{--                                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>--}}
                            {{--                                <li class="breadcrumb-item"><a href="/">User</a></li>--}}
                            {{--                                <li class="breadcrumb-item active">Profile</li>--}}
                            {{--                            </ul>--}}
                        </div>
                    </div>
                </div>

                <main class="">

                    @yield('content')
                </main>

            </div>
            {{--        </div>--}}


        </div>
        {{--    <footer class="page-footer font-small pt-4">--}}
        {{--        <div class="footer-copyright text-center ">© 2020 Copyright:--}}
        {{--            <a href="#">UZ</a>--}}
        {{--        </div>--}}
        {{--    </footer>--}}
    </div>
{{--    <script src="{{ mix('js/app.js') }}"></script>--}}
    @yield('js')
    @include('sweetalert::alert')
</body>
</html>
