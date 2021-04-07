@extends('layouts.admin')

@section('css')
    <style>
    </style>
@endsection

@section('content')
{{--    <div class="content container-fluid">--}}

{{--        <div class="page-header">--}}
{{--            <div class="row my-4">--}}
{{--                <div class="col-md-12 ">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-10">--}}
{{--                            <h3 class="page-title">List of {{ $role }}</h3>--}}
{{--                            <ul class="breadcrumb p-0">--}}
{{--                                <li class="breadcrumb-item"><a href="/">Dashboard</a>--}}
{{--                                </li>--}}
{{--                                <li class="breadcrumb-item"><a href="">Users</a></li>--}}
{{--                                <li class="breadcrumb-item active">{{ $role }}</li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="col-md-12 d-flex justify-content-end align-items-end pb-3">
            <div class="katrori">
                <a class="btn-hover" href="{{ route('staff_form') }}">New</a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="DataTables_Table_24_wrapper" class="dataTables_wrapper no-footer">

                                <table class="datatable table table-hover table-center mb-0 dataTable no-footer">
                                    <thead>
                                    <tr role="row">
                                        <th style="width: 200px;">Doctor Name</th>
                                        <th style="width: 180px;">Email</th>
                                        <th style="width: 82px;">Phone</th>
                                        <th style="width: 250px;">Member Since</th>
                                        <th style="width: 100px;">Account Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($staff_ as $doctor)

                                        <tr>
                                            <td class="">
                                                <h6 class="">
                                                    <a href="{{ route("staff.profile", [$doctor->id]) }}">
                                                        <img alt="User Image" class="avatar"
                                                             src="@if($doctor->image!=null)
                                                             {{ asset($doctor->image) }}
                                                             @else
                                                             {{ asset('user_images/no-photo.jpg') }}
                                                             @endif ">
                                                        <span href="#"><strong>{{ $doctor->name }}</strong></span>
                                                    </a>
                                                </h6>
                                            </td>
                                            <td class="align-middle">{{ $doctor->email }}</td>
                                            <td class="align-middle">{{ $doctor->phone }}</td>
                                            <td class="align-middle">{{ $doctor->created_at }}</td>
                                            <td class="align-middle">
                                                <div class="switches">
                                                    <input type="checkbox"
                                                           @if($doctor->isactive==1){{ 'checked' }}   @endif id="{{ $doctor->id }}"/>
                                                    <label for="{{ $doctor->id }}">
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                                <div>
                                    {{ $staff_->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
{{--    </div>--}}




@endsection
