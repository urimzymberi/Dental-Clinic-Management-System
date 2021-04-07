@extends('layouts.user')


@section('css')

@endsection

@section('content')
    <div class="container pt-3">
        <div class="col-md-12 d-flex justify-content-end align-items-end pb-3">
            <div class="katrori">
                <a class="btn-hover" href="{{ asset('doctors') }}">New Appointment</a>
            </div>
        </div>
        <div class="card card-table mr-4 mb-0">

            <div class="card-body">
                <div id="dataTableFilter" class="">
                    <label>Search:
                        <input type="search" class="" placeholder="">
                    </label>
                </div>
                <div class="table-responsive">

                    <table class="table table-hover table-center">
                        <thead>
                        <tr>
                            <th style="width: 300px">Doctor Name</th>
                            <th>Appt Date</th>
                            <th>Purpose</th>
                            <th>Type</th>
                            <th>Phone</th>
                            <th class="text-center">Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($appointments as $appointment)
                            <tr>
                                <td class="align-middle">
                                    <h6 class="table-avatar">
                                        <a href="{{ route("staff.profile", [$appointment->staff->id]) }}"
                                           class="avatar  mr-2">
                                            <img alt="User Image" class="avatar"
                                                 src="{{ asset($appointment->staff->image) }}">
                                        </a>
                                        <a href="{{ route("staff.profile", [$appointment->staff->id]) }}">{{ $appointment->staff->name }}</a>
                                    </h6>
                                </td>
                                @php
                                    $appt_date = strtotime($appointment->appointment_date_time);
                                @endphp
                                <td class="align-middle">{{ date('Y-m-d', $appt_date) }} <br> {{ date('H:i:s', $appt_date) }}</td>
                                <td class="align-middle text-center">{{ $appointment->description }}</td>
                                @php
                                    $appt_count = $appointments->where('patient_id', $appointment->patient_id)->count();
                                    $type = '';
                                    if($appt_count >= 2){
                                        $type = 'Old patient';
                                    } else {
                                        $type = 'New patient';
                                    }
                                @endphp
                                <td class="align-middle">{{ $type }}</td>
                                <td class="align-middle">{{ $appointment->patient->phone }}</td>
                                <td class="align-middle text-right">

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
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-end pr-3">
                {{ $appointments->links() }}
            </div>
        </div>
    </div>
@endsection

