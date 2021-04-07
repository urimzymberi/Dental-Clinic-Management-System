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


                            <div class="col-auto profile-btn">
                                <a href="{{asset("staff/patient_form/".$patient->id)}}" class="btn btn-primary"> <i
                                        class="fa fa-edit mr-1"></i>Edit </a>
                            </div>

                        </div>
                    </div>
                </div>
                <br>
                {{--                /*********************************************************************************************************/--}}


                <div class="card">
                    <div class="pt-3 pl-4">
                        <h4>Appointments</h4>
                    </div>
                    <div class="card-body pt-3">
{{--                        <div class="user-tabs">--}}
{{--                            <ul class="nav nav-tabs nav-tabs-bottom nav-justified flex-wrap">--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="#pat_appointments" data-toggle="tab"--}}
{{--                                       class="nav-link active">Appointments</a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="#pres" data-toggle="tab" class="nav-link">--}}
{{--                                        <span>Prescription</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="#medical" data-toggle="tab" class="nav-link">--}}
{{--                                        <span class="med-records">Medical Records</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="#billing" data-toggle="tab" class="nav-link">--}}
{{--                                        <span>Billing</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
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
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($appointments as $appointment)
                                                    <tr>
                                                        <td>
                                                            <h6 class="table-avatar">
                                                                <a class="" href="">
                                                                    @if($appointment->staff->image != null)
                                                                        <img src="{{ asset($appointment->staff->image) }}" alt="User Image" class="avatar">
                                                                    @else
                                                                        <img src="{{ asset('user_images/no-photo.jpg') }}" alt="User Image" class="avatar">
                                                                    @endif

                                                                </a>
                                                                <a href="">{{ $appointment->staff->name }}</a>
                                                            </h6>
                                                        </td>
                                                        <td> {{ $appointment->appointment_date_time }}</span>
                                                        </td>
                                                        <td> {{ $appointment->created_at }}</td>
                                                        <td>
                                                            @if($appointment->status == 2)
                                                                <span class="badge badge-success">'Confirm'</span>
                                                            @elseif($appointment->status == 3)
                                                                <span class="badge badge-info">'Complete'</span>
                                                            @elseif($appointment->status == 4)
                                                                <span class="badge badge-danger">'Cancelled'</span>
                                                            @else
                                                                <span class="badge badge-warning">'Pending'</span>
                                                            @endif
                                                        </td>
                                                        <td class="text-right">
                                                            <input type="hidden" id="appt_date_{{ $appointment->id }}" value="{{ $appointment->appointment_date_time }}">
                                                            <input type="hidden" id="patient_name_{{ $appointment->id }}" value="{{ $appointment->patient->name }}">
                                                            <div class="table-action">
                                                                <button data-toggle="modal" data-target="#editAppointmetnStatus" id="{{$appointment->id}}"  class="btn  btn-link pt-0" onclick="modal_data(this.id)"><i class="fa fa-edit"></i> Edit Status</button>
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

<div class="modal fade" id="editAppointmetnStatus" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <form action="{{ route('staff.submit_edit_appointment_status') }}" method="Post">
            @csrf
            <input type="hidden" id="id" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center">
                    <p class="modal-title"><i class="fa fa-calendar-check text-primary fa-4x"></i></p>
                    <h3>Edit status appointment!</h3>

                    <table class="d-flex justify-content-center h5">
                        <tr>
                            <td class="text-right p-1">Patient Name:</td>
                            <td class="text-left p-1"> <span id="patient_name_appt"></span> </td>
                        </tr>
                        <tr>
                            <td class="text-right p-1">Appointment Date:</td>
                            <td class="text-left p-1"><span id="appt_date"></span></td>
                        </tr>
                    </table>
                    <div>
                        <label class="p-2">
                            <input type="radio" style="background-color: #5AAF48aa" class="option-input radio" value="2" name="status" />
                            <div>Confirm</div>
                        </label>
                        <label class="p-2">
                            <input type="radio" style="background-color: #1DB9B3aa" class="option-input radio" value="3" name="status"  />
                            <div>Complete</div>
                        </label>
                        <label class="p-2">
                            <input type="radio" style="background-color: #E63C3Caa" class="option-input radio" value="4" name="status" />
                            <div>Cancel</div>
                        </label>
                    </div>
                    <br>
                    <input type="submit" class="btn btn-primary" value="Save Status">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
    <script>
        function modal_data(id) {
            document.getElementById('id').value = id;
            document.getElementById('patient_name_appt').innerHTML = document.getElementById('patient_name_'+id).value;
            document.getElementById('appt_date').innerHTML = document.getElementById('appt_date_'+id).value;
        }
    </script>
@endsection
