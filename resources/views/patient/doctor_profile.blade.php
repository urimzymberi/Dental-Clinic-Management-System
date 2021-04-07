@extends('layouts.user')

@section('css')
@endsection

@section('content')

    <div class="content container-fluid">

        <div class="breadcrumb-bar pl-3 pt-4 m-3">
            <div class="page-header">
                <div class="row ">
                    <div class="col-md-12">
                        <h3 class="page-title">Profile</h3>
                    </div>
                </div>
            </div>
        </div>
</div>
    <div class="container">
        <div class="row pb-2">
            <div class="col-md-12">
                <div class="profile-header card ">

                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto ">
                                <a href="#">
                                    <img alt="User Image" width="113" height="150"
                                         src="{{ $doctor->image != null? asset($doctor->image) : asset('user_images/no-photo.jpg') }}">
                                </a>
                            </div>
                            <div class="col ml-md-n2 profile-user-info">
                                <h4 class="user-name mb-0">{{ $doctor->name }}</h4>
                                <h6 class="text-muted">{{ $doctor->email }}</h6>
                                <div class="user-Location"><i class="fa fa-map-marker"></i>{{ $doctor->city }}
                                    , {{ $doctor->state }} </div>
                                <div class="about-text">{{ $doctor->address }}</div>
                            </div>

                        </div>
                    </div>
                </div>
                <br>

                <div class="py-3">
                    <div class="row">
                        <div class="col-md-12 pr-0">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title d-flex justify-content-between">
                                        <span>Personal Details</span>
                                        {{--                                            <a href="{{asset("admin/staff_form/".$staff->id)}}" class="edit-link"><i--}}
                                        {{--                                                    class="fa fa-edit mr-1"></i>Edit</a>--}}
                                    </h5>
                                    <div class="row">
                                        <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Name</p>
                                        <p class="col-sm-10">{{ $doctor->name }}</p>
                                    </div>
                                    <div class="row">
                                        <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Date of Birth</p>
                                        <p class="col-sm-10">{{ $doctor->date_of_birth }}</p>
                                    </div>
                                    <div class="row">
                                        <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Email ID</p>
                                        <p class="col-sm-10">{{ $doctor->email }}</p></div>
                                    <div class="row">
                                        <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Mobile</p>
                                        <p class="col-sm-10">{{ $doctor->phone }}</p>
                                    </div>
                                    <div class="row">
                                        <p class="col-sm-2 text-muted text-sm-right mb-0">Address</p>
                                        <p class="col-sm-10 mb-0">{{ $doctor->address }}
                                            <br>
                                            {{ $doctor->city }}
                                            <br>
                                            {{ $doctor->state }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
