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

    {{--    <div class="col-md-12 d-flex justify-content-end align-items-end pb-3">--}}
    {{--        <div class="katrori">--}}
    {{--            <a class="d-none btn-hover" href="#">New</a>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    <div class="card card-table mb-0">

        <div class="card-body">
            <form action="{{ route('staff.search_appointments') }}" method="get">
                <div class="d-flex justify-content-end">
                    @if(Auth::guard('staff')->user()->role !='doctor')
                    <div class="col-md-2">
                        <div class="form-group">
                            <select name="doctor" id="doctor" class="form-control select">
                                @php
                                    if(!isset($doctor_id) || @$doctor_id==0){
                                        echo "<option value='0'>--Select Doctor--</option>";
                                        foreach ($doctors as $doctor){
                                            echo "<option value='" .$doctor->id. "'>" .$doctor->name. "</option>";
                                        }
                                    } else {
                                        $doc = $doctors->find($doctor_id)->toArray();
                                        echo "<option value='".$doctor_id."'>". $doc['name'] ."</option>";
                                        echo "<option value='0'>--Select Doctor--</option>";
                                        foreach ($doctors as $doctor){
                                            echo "<option value='" .$doctor->id. "'>" .$doctor->name. "</option>";
                                        }
                                    }
                                @endphp
                            </select>
                        </div>
                    </div>
                    @endif
                    <div class="col-md-2">
                        <input type="text" name="patient" class="form-control" placeholder="Patient name"
                               value="{{ @$search_patient_name }}">
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <select name="status" class="form-control select">
                                @php
                                    $status_array = ['--Select Status--','Pending','Confirm', 'Completed', 'Cancelled'];
                                    if(!isset($status) || @$status==0){
                                        for($i=0 ; $i<count($status_array);  $i++){
                                            echo "<option value='$i'>$status_array[$i]</option>";
                                        }
                                    } else {
                                        echo "<option value='$status'>$status_array[$status]</option>";
                                        for($i=0 ; $i<count($status_array);  $i++){
                                            if ($i != $status){
                                                echo "<option value='$i'>$status_array[$i]</option>";
                                            }
                                        }
                                    }
                                @endphp

                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-outline-primary"><i class="fa fa-search-plus fa-lg"></i></button>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-hover table-center">
                    <thead>
                    <tr>
                        <th style="width: 300px" @if(Auth::guard('staff')->user()->role == 'doctor') {{ 'hidden' }}@endif>
                            Doctor Name
                        </th>
                        <th style="width: 150px">Patient Name</th>
                        <th style="width: 110px">Appt Date</th>
                        <th style="min-width: 150px">Purpose</th>
                        <th style="width: 50px">Type</th>
                        <th style="width: 50px">Phone</th>
                        <th style="width: 70px" class="text-center">Status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($appointments as $appointment)
                        <tr>
                            <td class="align-middle" @if(Auth::guard('staff')->user()->role == 'doctor') {{ 'hidden' }}@endif>
                                <h6 class="table-avatar">
                                    <a href="{{ route("staff.profile", [$appointment->staff->id]) }}"
                                       class="avatar  mr-2">
                                        <img alt="User Image" class="avatar"
                                             src="{{ asset($appointment->staff->image) }}">
                                    </a>
                                    <a href="{{ route("staff.profile", [$appointment->staff->id]) }}">{{ $appointment->staff->name }}</a>
                                </h6>
                            </td>
                            <td class="align-middle">
                                <a href="{{ route('staff.patient_profile', [$appointment->patient->id]) }}">{{ $appointment->patient->name }}</a>
                            </td>
                            @php
                                $appt_date = strtotime($appointment->appointment_date_time);
                            @endphp
                            <td class="align-middle">{{ date('Y-m-d', $appt_date) }}
                                <br> {{ date('H:i:s', $appt_date) }}</td>
                            <td class="align-middle text-wrap">{{ $appointment->description }}</td>
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
                            <td class="align-middle text-right">
                                <input type="hidden" id="appt_date_{{ $appointment->id }}"
                                       value="{{ $appointment->appointment_date_time }}">
                                <input type="hidden" id="patient_name_{{ $appointment->id }}"
                                       value="{{ $appointment->patient->name }}">
                                <input type="hidden" id="status_{{ $appointment->id }}"
                                       value="{{ $appointment->status }}">
                                <div class="table-action">
                                    <button data-toggle="modal" data-target="#editAppointmetnStatus"
                                            id="{{$appointment->id}}" class="btn  btn-link pt-0"
                                            onclick="modal_data(this.id)"><i class="fa fa-edit"></i> Edit
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                {{ $appointments->links() }}
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
                                <td class="text-left p-1"><span id="patient_name_appt"></span></td>
                            </tr>
                            <tr>
                                <td class="text-right p-1">Appointment Date:</td>
                                <td class="text-left p-1"><span id="appt_date"></span></td>
                            </tr>
                        </table>
                        <div>
                            <label class="p-2">
                                <input type="radio" id="chck_confirm" style="background-color: #5AAF48aa"
                                       class="option-input radio" value="2" name="status">
                                <div>Confirm</div>
                            </label>
                            <label class="p-2">
                                <input type="radio" id="chck_complete" style="background-color: #1DB9B3aa"
                                       class="option-input radio" value="3" name="status"/>
                                <div>Complete</div>
                            </label>
                            <label class="p-2">
                                <input type="radio" id="chck_Cancel" style="background-color: #E63C3Caa"
                                       class="option-input radio" value="4" name="status"/>
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
            var status = document.getElementById('status_' + id).value;
            var id_chck;
            document.getElementById('id').value = id;
            document.getElementById('patient_name_appt').innerHTML = document.getElementById('patient_name_' + id).value;
            document.getElementById('appt_date').innerHTML = document.getElementById('appt_date_' + id).value;
            switch (parseInt(status)) {

                case 2:
                    id_chck = 'chck_confirm';
                    break;

                case 3:
                    id_chck = 'chck_complete';
                    break;

                case 4:
                    id_chck = 'chck_cancel';
                    break;

                default:
                    id_chck = null;
                    break;
            }
            if (id_chck != null) {
                document.getElementById(id_chck).setAttribute('checked', true);
            } else {
                document.getElementById('chck_confirm').removeAttribute('checked', true);
                document.getElementById('chck_complete').removeAttribute('checked', true);
                document.getElementById('chck_cancel').removeAttribute('checked', true);
            }
        }
    </script>
@endsection

