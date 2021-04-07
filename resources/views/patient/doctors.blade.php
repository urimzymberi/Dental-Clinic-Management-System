@extends('layouts.user')


@section('css')
    <style>
        .available-info {
            list-style: none;
        }
    </style>
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="row align-items-center mb-4">
                <div class="col-md-12 col">
                    <h4>{{ $doctors->count() }} Doctors found</h4>
                </div>
            </div>


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
                                @php
                                        $service = json_decode($doctor->service, true);
                                        if(!is_array($service)){
                                            $service = array();
                                        }
                                        $specialization = json_decode($doctor->specialization, true);
                                        if(!is_array($specialization)){
                                            $specialization = array();
                                        }
                                @endphp
                                <h6 class="mb-0">{{ array_key_exists('service', $service) ? $service['service']: '' }}</h6>
                                <h6 class="mb-0">{{ array_key_exists('specialization', $specialization) ? $specialization['specialization']: '' }}</h6>

                                <div class="text-center">
                                    <i class="fa fa-map-marker"></i> {{ $doctor->city }}, {{ $doctor->state }}
                                </DIV>
                                <div class="row px-0 mx-0">
                                    <div class="col-6">
                                        <a class="btn w-100 btn-outline-primary"
                                           href="{{ route('patient.doctor_profile', [$doctor->id]) }}">View Profile</a>
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

@endsection

