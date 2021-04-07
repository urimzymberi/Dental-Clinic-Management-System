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

    </style>
</head>
<body>
<div id="app">
    <nav id="header-nav" class="navbar navbar-expand-md navbar-light shadow-sm">
        <div class="container-fluid">
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


                        {{--                            @if (Route::has('login'))--}}
                        {{--                                <li hidden class="nav-item">--}}
                        {{--                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
                        {{--                                </li>--}}
                        {{--                            @endif--}}

                        {{--                            @if (Route::has('register'))--}}
                        {{--                                <li hidden class="nav-item">--}}
                        {{--                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
                        {{--                                </li>--}}
                        {{--                            @endif--}}
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

                    @if(Auth::guard('staff')->check())
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
                    @elseif(Auth::guard('patient')->check())
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::guard('patient')->user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('patient.profile') }}">Profile</a>
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

    @if(Auth::guard('staff')->check())
        <div class="pb-3">
            <div class="col-md-12 pl-0 pr-0">
                <div class="breadcrumb-bar">
                    <div class="">
                        <div class="row align-items-center">
                            <div class="col-md-12 col-12 pt-3">
                                {{--                                <nav class="page-breadcrumb">--}}
                                {{--                                    <ol class="breadcrumb">--}}
                                {{--                                        <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
                                {{--                                        <li class="breadcrumb-item">Doctor</li>--}}
                                {{--                                    </ol>--}}
                                {{--                                </nav>--}}
                                <p class="breadcrumb-title">{{ $page_title }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-3 pt-3 pl-5">
                <nav class="nav-staff ">
                    <div class="text-center">
                        <a href="#">
                            <img width="100" height="125" src="{{ asset(Auth::guard('staff')->user()->image) }}"
                                 alt="User Image" class="">
                        </a>
                        <div class="text-center pt-2">
                            <h4 class="">{{ Auth::guard('staff')->user()->name }}</h4>
                            <div class="text-center">
                                @php
                                $staff_on = Auth::guard('staff')->user();
                                    $service = json_decode($staff_on->service, true);
                                    if(!is_array($service)){
                                        $service = array();
                                    }
                                    $specialization = json_decode($staff_on->specialization, true);
                                    if(!is_array($specialization)){
                                        $specialization = array();
                                    }
                                @endphp
                                <h6 class="mb-0">{{ array_key_exists('service', $service) ? $service['service']: '' }}</h6>
                                <h6 class="mb-0">{{ array_key_exists('specialization', $specialization) ? $specialization['specialization']: '' }}</h6>
                            </div>
                        </div>
                    </div>
                    <p class="">Main</p>
                    <ul>
                        <li><a href="{{ route('staff.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('staff.appointments') }}">Appointments</a></li>
                        <li><a href="{{ route('staff.patients') }}">Patients</a></li>
                    </ul>
                </nav>
            </div>

            @endif

            @if(Auth::guard('staff')->check())
                <div class="col-md-9 pt-3">
                    @else
                        <div class="col-md-12 pt-3">
                            @endif
                            @yield('content')
                        </div>
                </div>
                <footer class="page-footer font-small pt-4">
                    <div class="footer-copyright text-center ">© 2020 Copyright:
                        <a href="#">UZ</a>
                    </div>
                </footer>
        </div>
{{--        <script src="{{ mix('js/app.js') }}"></script>--}}
@yield('js')
@include('sweetalert::alert')
</body>
</html>
