@php
    if(Auth::guard('staff')->user()->role == 'admin'){
            $layout = 'layouts.admin';
            } else {   //if(Auth::guard('staff')->user()->role == 'doctor' || Auth::guard('staff')->user()->role == 'receptionist'){
            $layout = 'layouts.user';
            }
@endphp

@extends($layout)

@section('content')

    <div class="row pb-4">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon text-primary border-primary"><i class="fa fa-users"></i></span>
                        <div class="dash-count">
                            <h3>{{ $doctor_count }}</h3>
                        </div>
                    </div>
                    <div class="dash-widget-info">
                        <h6 class="text-muted">Doctors</h6>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-primary w-100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header"><span class="dash-widget-icon text-warning border-warning"><i
                                class="fa fa-folder"></i></span>
                        <div class="dash-count">
                            <h3>{{ $receptionist_count }}</h3>
                        </div>
                    </div>
                    <div class="dash-widget-info">
                        <h6 class="text-muted">Receptionist</h6>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-warning w-100"></div>
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
                            <h3>{{ $patient_count }}</h3>
                        </div>
                    </div>
                    <div class="dash-widget-info">
                        <h6 class="text-muted">Patients</h6>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-success w-100"></div>
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
                            <h3>{{ $appointment_count }}</h3>
                        </div>
                    </div>
                    <div class="dash-widget-info">
                        <h6 class="text-muted">Appointment</h6>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-danger w-100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 d-flex">
            <div class="card card-table flex-fill">
                <div class="card-header">
                    <h4 class="card-title">Doctors List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-center mb-0">
                            <thead>
                            <tr>
                                <th>Doctor Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($doctors as $doctor)
                            <tr>
                                <td>
                                    <h5 class="table-avatar">
                                            <img src="{{ asset($doctor->image) }}"
                                                 alt="User Image"
                                                 class="avatar">
                                        {{ $doctor->name }}
                                    </h5>
                                </td>
                                <td class="align-middle">{{ $doctor->email }}</td>
                                <td class="align-middle">{{ $doctor->phone }}</td>
                            </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 d-flex">
            <div class="card card-table flex-fill">
                <div class="card-header">
                    <h4 class="card-title">Patients List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-center mb-0">
                            <thead>
                            <tr>
                                <th>Patient Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($patients as $patient)
                            <tr>
                                <td>
                                    <h5>
                                        {{ $patient->name }}
                                    </h5>
                                </td>
                                <td>{{ $patient->email }}</td>
                                <td>{{ $patient->phome }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row pt-4">
        <div class="col-md-12">
            <div class="card card-table">
                <div class="card-header">
                    <h4 class="card-title"> Appointment List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-center mb-0">
                            <thead>
                            <tr>
                                <th>Doctor Name</th>
                                <th>Patient Name</th>
                                <th>Apointment Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($appointments as $appointment)
                            <tr>
                                <td>
                                    <h5>
                                        <img src="{{ asset($appointment->staff->image) }}"
                                                 alt="User Image"
                                                 class="avatar">
                                        {{ $appointment->staff->name }}
                                    </h5>
                                </td>
                                <td>
                                    <h5>
                                        {{ $appointment->patient->name }}
                                    </h5>
                                </td>
                                <td>{{ $appointment->appointment_date_time }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
