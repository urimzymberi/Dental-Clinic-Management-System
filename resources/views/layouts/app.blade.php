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
            height: 85px;
        }

        .btn-hover {
            text-transform: uppercase;
        }
        .footer{
            background-color: #1B5A90;
            color: white;
        }
        .footer-logo img{
            height: 80px;
            padding-bottom: 10px;
        }
        .footer p, .footer a{
            font-size: 16px;
        }
        .list-link{
            list-style-type: none;

        }
        .list-link li a{
            color: white;
         }

        .list-link li ::before{
            content: "\00BB";
            font-size: 20px;
        }


        .social-icon ul li{
            display: inline;
            padding-right: 20px;
        }
        .social-icon ul li a{
            color: white;
            font-size: 22px;
        }
        .policy-menu li{
            display: inline;
        }
        .policy-menu li a{
            color: white;
        }
    </style>
</head>
<body>
<div id="app">
    <nav id="header-nav" class="navbar navbar-expand-md navbar-light shadow-sm">
        <div class="container-fluid">

            <a class="navbar-brand" href="{{ url('/') }}">
                <img height="50" src="{{ asset('images/dcms_logo1.png') }}" alt="Logo">
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
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">About US</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ asset('doctors') }}">Doctors</a>
                    </li>
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

                    @if(Auth::guard('staff')->check())
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::guard('staff')->user()->name }}
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
                    @elseif(Auth::guard('patient')->check())
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::guard('patient')->user()->name }}
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
            {{--            </div>--}}
        </div>
    </nav>

    <main class="">

        @yield('content')

    </main>
    {{--    <footer class="page-footer font-small pt-4">--}}
    {{--        <div class="footer-copyright text-center ">© 2020 Copyright:--}}
    {{--            <a href="#">UZ</a>--}}
    {{--        </div>--}}
    {{--    </footer>--}}


    <footer class="footer px-3 pt-5">
        <div class="footer-top">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget footer-about">
                            <div class="footer-logo">
                                <img src="{{ asset('images/dcms_logo2.png') }}" alt="logo">
                            </div>
                            <div class="footer-about-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqua. </p>
                                <div class="social-icon">
                                    <ul>
                                        <li>
                                            <a href="#"><i class="fa fa-facebook-f"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-linkedin"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-instagram"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-dribbble"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget footer-menu">
                            <h2 class="footer-title">For Patients</h2>
                            <ul class="list-link">
                                <li>
                                    <a href="{{ route('patient.doctors') }}">Doctors</a>
                                </li>
                                <li>
                                    <a href="{{ asset('plogin') }}">Login</a>
                                </li>
                                <li>
                                    <a href="{{ asset('patinet_form') }}">Register</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget footer-menu">
                            <h2 class="footer-title">For Doctors</h2>
                            <ul class="list-link">
                                <li>
                                    <a  href="{{ asset('slogin') }}">Login</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget footer-contact">
                            <h2 class="footer-title">Contact Us</h2>
                            <div class="footer-contact-info">
                                <div class="footer-address">
                                    <p><i class="fa fa-map-marker"></i>  Street,<br> Vushtrri, Kosove </p></div>
                                <p><i class="fa fa-phone"></i> +383 (0)45 946 643</p>
                                <p class="mb-0"><i class="fa fa-envelope"></i>dcms@dcms.com </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom border-top pt-4">
            <div class="container-fluid">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="copyright-text">
                                <p class="mb-0">© 2020 Dental Clinic Menagment System.</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="copyright-menu d-flex justify-content-end">
                                <ul class="policy-menu">
                                    <li>
                                        <a href="#">Terms and Conditions |</a>
                                    </li>
                                    <li>
                                        <a href="#"> Policy</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>


</div>
{{--<script src="{{ mix('js/app.js') }}"></script>--}}
@yield('js')
@include('sweetalert::alert')
</body>
</html>
