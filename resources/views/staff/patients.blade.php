@php
    if(Auth::guard('staff')->user()->role == 'admin'){
            $layout = 'layouts.admin';
            } else {   //if(Auth::guard('staff')->user()->role == 'doctor' || Auth::guard('staff')->user()->role == 'receptionist'){
            $layout = 'layouts.user';
            }
@endphp

@extends($layout)


@section('css')
    <style>
        .avatar {
            vertical-align: middle;
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

    </style>
@endsection

@section('content')
{{--    <div class="content container-fluid">--}}

{{--        <div class="page-header">--}}
{{--            <div class="row my-4">--}}
{{--                <div class="col-md-12 ">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-10">--}}
{{--                            <h3 class="page-title">List of Patients</h3>--}}
{{--                            <ul class="breadcrumb p-0">--}}
{{--                                <li class="breadcrumb-item"><a href="/">Dashboard</a>--}}
{{--                                </li>--}}
{{--                                <li class="breadcrumb-item"><a href="">Users</a></li>--}}
{{--                                <li class="breadcrumb-item active">Patients</li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}



{{--            <div class="col-md-12 d-flex justify-content-end align-items-end pb-3">--}}
{{--                <div class="katrori">--}}
{{--                    <a class="btn-hover" href="{{ route('staff.patient_form') }}">New</a>--}}
{{--                </div>--}}
{{--            </div>--}}

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="DataTables_Table_24_wrapper" class="dataTables_wrapper no-footer">

                                <table class="datatable table table-hover table-center mb-0 dataTable no-footer">
                                    <thead>
                                    <tr role="row">
                                        <th style="width: 200px;">Patient Name</th>
                                        <th style="width: 180px;">Age</th>
                                        <th style="width: 250px;">Address</th>
                                        <th style="width: 82px;">Phone</th>
                                        <th style="width: 100px;">Email</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($patients as $patient)

                                        <tr>
                                            <td class="">
                                                <h6 class="">
                                                    <a href="{{ route("staff.patient_profile", [$patient->id]) }}">
                                                        <span href="#"><strong>{{ $patient->name }}</strong></span>
                                                    </a>
                                                </h6>
                                            </td>
                                            <td>{{ date_diff( new DateTime($patient->date_of_birth),new DateTime(date('Y/m/d')))->y }}</td>
                                            <td>{{ $patient->address }}</td>
                                            <td>{{ $patient->phone }}</td>
                                            <td>{{ $patient->email }}</td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                                <div>
                                    {{ $patients->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
{{--    </div>--}}




@endsection
