@extends('layouts.app')

@section('css')
    <style>
        .wrapper {
            position: relative;
            height: 50vh;
            width: 100%;
            top: 0;
            overflow: hidden;
        }

        .slideshow {
            position: absolute;
            top: 0;
            left: 50%;
            width: 100%;
            height: 100%;
            transform: translateX(-50%);
        }

        .slideshow--hero {
            z-index: 3;
            left: 0;
            top: 50%;
            height: 85%;
            transform: translateY(-50%) skewY(-10deg);
            transform-origin: center;
            overflow: hidden;
            box-shadow: 0 0 1rem rgba(0, 0, 0, 0.25);
        }

        .slideshow--hero .slides {
            position: absolute;
            left: 0;
            top: 0;
            width: 100vw;
            height: 100vh;
            animation: 11s slideshow-hero-mobile -3s infinite;
        }

        .slideshow--hero .slide1 {
            background-image: url({{ asset('img_slideshow/1.jpg') }});
            animation: 20s slides-set-1 -0.1s infinite;
        }

        .slideshow--hero .slide2 {
            background-image: url({{ asset('img_slideshow/2.jpg') }});
            animation: 20s slides-set-2 -0.1s infinite;
        }

        .slideshow--hero .slide3 {
            background-image: url({{ asset('img_slideshow/3.jpeg') }});
            animation: 20s slides-set-3 -0.1s infinite;
        }

        @media (min-width: 600px) {
            .slideshow--hero {
                left: 50%;
                top: 0;
                width: 67%;
                height: 100%;
                transform: translateX(-50%) skewX(-10deg);
            }

            .slideshow--hero .slides {
                top: 0;
                left: -25%;
                height: 100%;
                animation: 11s slideshow-hero -3s infinite;
            }
        }

        .slideshow--contrast {
            z-index: 1;
            width: 100%;
            height: 50%;
            transform: none;
        }

        .slideshow--contrast--before {
            left: 0;
        }

        .slideshow--contrast--before .slides {
            width: 100vw;
        }

        .slideshow--contrast--after {
            z-index: 2;
            left: auto;
            right: 0;
        }

        .slideshow--contrast--after .slides {
            width: 100vw;
            left: auto;
            right: 0;
        }

        .slideshow--contrast .slides {
            animation: 14s slideshow-contrast -5s infinite;
        }

        .slideshow--contrast .slide1 {
            background-image: linear-gradient(to bottom, rgba(200, 200, 75, 0.25) 0, rgba(200, 75, 75, 0.5) 100%), url({{ asset('img_slideshow/1.jpg') }});
            animation: 20s slides-set-1 -0.2s infinite;
        }

        .slideshow--contrast .slide2 {
            background-image: linear-gradient(to bottom, rgba(200, 200, 75, 0.25) 0, rgba(200, 75, 75, 0.5) 100%), url({{ asset('img_slideshow/2.jpg') }});
            animation: 20s slides-set-2 -0.2s infinite;
        }

        .slideshow--contrast .slide3 {
            background-image: linear-gradient(to bottom, rgba(200, 200, 75, 0.25) 0, rgba(200, 75, 75, 0.5) 100%), url({{ asset('img_slideshow/3.jpeg') }});
            animation: 20s slides-set-3 -0.2s infinite;
        }

        .slideshow--contrast--after {
            top: auto;
            bottom: 0;
        }

        .slideshow--contrast--after .slides {
            animation: 13s slideshow-contrast -13s infinite;
        }

        .slideshow--contrast--after .slide {
            background-position: right;
        }

        .slideshow--contrast--after .slide1 {
            animation: 20s slides-set-1 infinite;
        }

        .slideshow--contrast--after .slide2 {
            animation: 20s slides-set-2 infinite;
        }

        .slideshow--contrast--after .slide3 {
            animation: 20s slides-set-3 infinite;
        }

        @media (min-width: 600px) {
            .slideshow--contrast {
                width: 50%;
                height: 100%;
            }

            .slideshow--contrast--after {
                top: 0;
                bottom: auto;
            }

            .slideshow--contrast--after .slides {
                width: 50vw;
            }
        }

        .slides, .slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }

        @keyframes slideshow-hero-mobile {
            0% {
                transform: scale(1) skewY(10deg);
            }
            50% {
                transform: scale(1.05) skewY(10deg);
            }
            100% {
                transform: scale(1) skewY(10deg);
            }
        }

        @keyframes slideshow-hero {
            0% {
                transform: scale(1) skewX(10deg);
            }
            50% {
                transform: scale(1.05) skewX(10deg);
            }
            100% {
                transform: scale(1) skewX(10deg);
            }
        }

        @keyframes slideshow-contrast {
            0% {
                transform: scale(1.05);
            }
            50% {
                transform: scale(1);
            }
            100% {
                transform: scale(1.05);
            }
        }

        @keyframes slides-set-1 {
            0% {
                opacity: 1;
                transform: scale(1);
            }
            31% {
                opacity: 1;
                transform: scale(1);
            }
            34% {
                opacity: 0;
                transform: scale(1.05);
            }
            97% {
                opacity: 0;
                transform: scale(1.05);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes slides-set-2 {
            0% {
                opacity: 0;
                transform: scale(1.05);
            }
            31% {
                opacity: 0;
                transform: scale(1.05);
            }
            34% {
                opacity: 1;
                transform: scale(1);
            }
            64% {
                opacity: 1;
                transform: scale(1);
            }
            67% {
                opacity: 0;
                transform: scale(1.05);
            }
            100% {
                opacity: 0;
                transform: scale(1.05);
            }
        }

        @keyframes slides-set-3 {
            0% {
                opacity: 0;
                transform: scale(1.05);
            }
            64% {
                opacity: 0;
                transform: scale(1.05);
            }
            67% {
                opacity: 1;
                transform: scale(1);
            }
            97% {
                opacity: 1;
                transform: scale(1);
            }
            100% {
                opacity: 0;
                transform: scale(1.05);
            }
        }

    </style>
@endsection

@section('content')


    <div>
        <div class="wrapper">
            <div class="slideshows">
                <div class="slideshow slideshow--hero">
                    <div class="slides">
                        <div class="slide slide1"></div>
                        <div class="slide slide2"></div>
                        <div class="slide slide3"></div>
                    </div>
                </div>
                <div class="slideshow slideshow--contrast slideshow--contrast--before">
                    <div class="slides">
                        <div class="slide slide1"></div>
                        <div class="slide slide2"></div>
                        <div class="slide slide3"></div>
                    </div>
                </div>
                <div class="slideshow slideshow--contrast slideshow--contrast--after">
                    <div class="slides">
                        <div class="slide slide1"></div>
                        <div class="slide slide2"></div>
                        <div class="slide slide3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>






    <div class="container">
        <div class="py-5">
            <div class="d-flex justify-content-center">
                <div class="text-center">
                    <h2>Clinic and Specialities</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,<br>
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon text-primary border-primary"><i
                                        class="fa fa-users"></i></span>
                                <div class="dash-count">
                                    <h3>5</h3>
                                </div>
                            </div>
                            <div class="dash-widget-info">
                                <h6 class="text-muted">Doctors</h6>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-primary w-50"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header"><span
                                    class="dash-widget-icon text-warning border-warning"><i
                                        class="fa fa-folder"></i></span>
                                <div class="dash-count">
                                    <h3>1</h3>
                                </div>
                            </div>
                            <div class="dash-widget-info">
                                <h6 class="text-muted">Receptionist</h6>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-warning w-50"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon text-success"><i class="fa fa-credit-card"></i></span>
                                <div class="dash-count">
                                    <h3>10</h3>
                                </div>
                            </div>
                            <div class="dash-widget-info">
                                <h6 class="text-muted">Patients</h6>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-success w-50"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header"><span class="dash-widget-icon text-danger border-danger"><i
                                        class="fa fa-money"></i></span>
                                <div class="dash-count">
                                    <h3>35</h3>
                                </div>
                            </div>
                            <div class="dash-widget-info">
                                <h6 class="text-muted">Appointment</h6>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-danger w-50"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 p-5">

                <div class="">
                    <h2>Book Our Doctor</h2>
                    <p>Lorem Ipsum is simply dummy text </p>
                </div>
                <div class="">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ut finibus sapien. Nunc sapien
                        augue, facilisis sed faucibus ut, tempor in massa. Nam a quam ut massa ultricies fringilla.
                        Aliquam id lacus auctor, efficitur est et, dictum turpis. Donec tincidunt maximus mi, id
                        porttitor leo finibus nec. Proin ut odio elementum, sollicitudin libero ac, molestie lacus.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ut finibus sapien. Nunc sapien
                        augue, facilisis sed faucibus ut, tempor in massa. Nam a quam ut massa ultricies fringilla.</p>
                    <a href="#">Read More..</a>
                </div>

            </div>
            <div class="col-md-8">
                <div class="row">
                    @foreach($doctors as $doctor)
                        <div class=" col-sm-6 col-md-4 pb-4">
                            <div class="card py-3 profile-widget">
                                <div class="text-center py-4">
                                    <a href="#">
                                        <img style="width: 160px; height: 212px" alt="User Image"
                                             src="{{ $doctor->image != null? asset($doctor->image) : asset('user_images/no-photo.jpg') }}">
                                    </a>
                                </div>
                                <div class="pro-content text-center px-4">
                                    <h4 class="title">
                                        <a href="#">{{ $doctor->name }}</a>
                                        <i class="fa fa-check-circle text-primary "></i>
                                    </h4>
                                    <p class="speciality">MDS - Periodontology and Oral Implantology, BDS</p>

                                    <ul class="available-info">
                                        <li><i class="fa fa-map-marker"></i> {{ $doctor->city }}, {{ $doctor->state }}
                                        </li>
                                    </ul>
                                    <div class="row px-0 mx-0">
                                        <div class="col-6">
                                            <a class="btn w-100 btn-outline-primary"
                                               href="{{ route('patient.doctor_profile', [$doctor->id]) }}">View
                                                Profile</a>
                                        </div>
                                        <div class="col-6">
                                            <a class="btn w-100 btn-primary"
                                               href="{{ route('patient.booking', [$doctor->id]) }}">Book Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
@endsection

