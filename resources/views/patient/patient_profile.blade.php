@extends('layouts.user')


@section('css')

@endsection

@section('content')

    <div class="container">

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


        <div class="row pb-2">
            <div class="col-md-12">
                <div class="profile-header card ">

                    <div class="card-body pl-5">
                        <div class="row align-items-center">
                            <div class="col ml-md-n2 profile-user-info">
                                <h4 class="user-name mb-0">{{ $patient->name }}</h4>
                                <h6 class="text-muted">{{ $patient->email }}</h6>
                                <div class="user-Location"><i class="fa fa-map-marker"></i>{{ $patient->city }}
                                    , {{ $patient->state }} </div>
                                <div class="about-text">{{ $patient->address }}</div>
                            </div>


                            <div class="col-auto">
                                <a href="{{ asset("patinet_form") }}" class="btn btn-primary"> <i
                                        class="fa fa-edit mr-1"></i>Edit </a>
                                <button data-toggle="modal"
                                        data-target="#change_password"
                                        class="btn  btn-outline-primary">
                                    <i class="fa fa-edit"></i>Password
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
                <br>

                <div class="card">
                    <div class="pt-3 pl-4">
                        <h4>Appointments</h4>
                    </div>
                    <div class="card-body pt-3">
                        <div class="tab-content">
                            <div id="pat_appointments" class="tab-pane fade show active">
                                <div class="card card-table mb-0">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-center mb-0">
                                                <thead>
                                                <tr>
                                                    <th>Doctor</th>
                                                    <th>Appt Date</th>
                                                    <th>Booking Date</th>
                                                    <th>Status</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($appointments as $appointment)
                                                    <tr>
                                                        <td>
                                                            <h6 class="table-avatar">
                                                                <a class="" href="">
                                                                    @if($appointment->staff->image != null)
                                                                        <img
                                                                            src="{{ asset($appointment->staff->image) }}"
                                                                            alt="User Image" class="avatar">
                                                                    @else
                                                                        <img
                                                                            src="{{ asset('user_images/no-photo.jpg') }}"
                                                                            alt="User Image" class="avatar">
                                                                    @endif

                                                                </a>
                                                                <a href="">{{ $appointment->staff->name }}</a>
                                                            </h6>
                                                        </td>
                                                        <td class="align-middle"> {{ $appointment->appointment_date_time }}</td>
                                                        <td class="align-middle"> {{ $appointment->created_at }}</td>
                                                        <td class="align-middle">
                                                            @if($appointment->status == 1)
                                                                <span class="badge badge-success">'Confirm'</span>
                                                            @elseif($appointment->status == 2)
                                                                <span class="badge badge-info">'Complete'</span>
                                                            @elseif($appointment->status == 3)
                                                                <span class="badge badge-danger">'Cancelled'</span>
                                                            @else
                                                                <span class="badge badge-warning">'Pending'</span>
                                                            @endif
                                                        </td>
                                                        <td class="text-right">
                                                            <input type="hidden" id="appt_date_{{ $appointment->id }}"
                                                                   value="{{ $appointment->appointment_date_time }}">
                                                            <input type="hidden"
                                                                   id="patient_name_{{ $appointment->id }}"
                                                                   value="{{ $appointment->patient->name }}">
                                                            <div class="table-action">

                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="d-flex justify-content-end pr-3">
                        {{ $appointments->links() }}
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
                                <td class="text-left p-1"><span>{{ Auth::guard('patient')->user()->name }}</span></td>
                            </tr>
                            <tr>
                                <td class="text-right p-1">Last Updated:</td>
                                <td class="text-left p-1"><span>{{ Auth::guard('patient')->user()->updated_at }}</span></td>
                            </tr>
                        </table>

                        <div class="col-md-12">
                            <form action=" {{ route('patient.change_password') }}" method="post">
                                @csrf
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
    </div>
@endsection

@section('js')
    <script>
    </script>
@endsection
