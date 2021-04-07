@php
    if(Auth::guard('staff')->user()->role == 'admin'){
            $layout = 'layouts.admin';
            } else {   //if(Auth::guard('staff')->user()->role == 'doctor' || Auth::guard('staff')->user()->role == 'receptionist'){
            $layout = 'layouts.user';
            }
@endphp

@extends($layout)

@section('css')
@endsection

@section('content')

    {{--    <div class="content container-fluid">--}}

    {{--        <div class="page-header">--}}
    {{--            <div class="row my-4">--}}
    {{--                <div class="col-md-12">--}}
    {{--                    <h3 class="page-title">Profile</h3>--}}
    {{--                    <ul class="breadcrumb p-0">--}}
    {{--                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>--}}
    {{--                        <li class="breadcrumb-item"><a href="/">User</a></li>--}}
    {{--                        <li class="breadcrumb-item active">Profile</li>--}}
    {{--                    </ul>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}


    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('sukses') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('gabim') }}
        </div>
    @endif

    <div class="row pb-2">
        <div class="col-md-12">
            <div class="profile-header card ">

                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto ">
                            <a href="#">
                                <img alt="User Image" width="113" height="150" src="{{ asset($staff->image) }}">
                            </a>
                        </div>
                        <div class="col ml-md-n2 profile-user-info">
                            <h4 class="user-name mb-0">{{ $staff->name }}</h4>
                            <h6 class="text-muted">{{ $staff->email }}</h6>
                            <div class="user-Location"><i class="fa fa-map-marker"></i>{{ $staff->city }}
                                , {{ $staff->state }} </div>
                            <div class="about-text">{{ $staff->address }}</div>
                        </div>

                        @if(Auth::guard('staff')->user()->role == 'admin' || Auth::guard('staff')->user()->id == $staff->id)
                            <div class="col-auto profile-btn">
                                <a href="{{asset("staff/staff_form/".$staff->id)}}" class="btn btn-primary"> <i
                                        class="fa fa-edit mr-1"></i>Edit </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <br>

            <div class="tab-content profile-tab-cont py-3">
                <div id="per_details_tab" class="tab-pane fade show active">
                    <div class="row">
                        <div class="col-md-12 pr-0">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <h5 class="card-title d-flex justify-content-between">
                                                <span>Personal Details</span>
                                            </h5>
                                            <div class="row">
                                                <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Name</p>
                                                <p class="col-sm-10">{{ $staff->name }}</p>
                                            </div>
                                            <div class="row">
                                                <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Date of
                                                    Birth</p>
                                                <p class="col-sm-10">{{ $staff->date_of_birth }}</p>
                                            </div>
                                            <div class="row">
                                                <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Email</p>
                                                <p class="col-sm-10">{{ $staff->email }}</p></div>
                                            <div class="row">
                                                <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Phone</p>
                                                <p class="col-sm-10">{{ $staff->phone }}</p>
                                            </div>
                                            <div class="row">
                                                <p class="col-sm-2 text-muted text-sm-right mb-0">Address</p>
                                                <p class="col-sm-10 mb-0">{{ $staff->address }},
                                                    <br>
                                                    {{ $staff->city }},
                                                    <br>
                                                    {{ $staff->state }}
                                                </p>
                                            </div>
                                        </div>
                                        @if(Auth::guard("staff")->user()->id == $staff->id)
                                            <div class="col-md-2 d-flex align-items-center justify-content-end">
                                                <button data-toggle="modal" data-target="#change_password"
                                                        id="{{'test'}}"
                                                        class="btn  btn btn-primary" onclick="modal_data(this.id)"><i
                                                        class="fa fa-key"></i>
                                                    Password
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="change_password" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <input type="hidden" id="id" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <h3 class=" text-center">Change Password</h3>

                    <table class="d-flex justify-content-center">
                        <tr>
                            <td class="text-right p-1">Name:</td>
                            <td class="text-left p-1"><span>{{ $staff->name }}</span></td>
                        </tr>
                        <tr>
                            <td class="text-right p-1">Last Updated:</td>
                            <td class="text-left p-1"><span>{{ $staff->updated_at }}</span></td>
                        </tr>
                    </table>

                    <div class="col-md-12">
                        <form action=" {{ route('staff.change_password') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $staff->id }}">
                            <div class="form-group">
                                <label>Old Password</label>
                                <input type="password" name="old_password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit"
                                        class="col-md-10 btn btn-primary">Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

