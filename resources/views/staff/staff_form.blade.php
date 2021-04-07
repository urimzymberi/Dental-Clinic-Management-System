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

    </style>
@endsection

@section('content')
{{--    <div class="container-fluid">--}}

{{--        <div class="page-header">--}}
{{--            <div class="row my-4">--}}
{{--                <div class="col-md-12">--}}
{{--                    <h3 class="page-title">Edit Profile</h3>--}}
{{--                    <ul class="breadcrumb p-0">--}}
{{--                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>--}}
{{--                        <li class="breadcrumb-item"><a href="/">User</a></li>--}}
{{--                        <li class="breadcrumb-item active">Profile</li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <form method="post" enctype="multipart/form-data" action="{{ route('submit_staff_form') }}">
            @csrf
            <div class="card my-4">
                <div class="card-title pt-3 pl-3">
                    <h4>Basic Information</h4>
                </div>
                <div class="card-body pt-0">
                    <input type="hidden" name="id" value="{{ $staff->id  }}">
                    <div class="row form-row">
                        <div class="col-12 col-md-12">
                            <div class="form-group">
                                <div class="row d-flex align-items-center">
                                    <div class="col-auto profile-img">
                                        @if($staff->image == null)
                                            <img id="imagebox" width="113" height="150"
                                                 src="{{ asset('user_images/no-photo.jpg') }}" alt="User Image">
                                        @else
                                            <img id="imagebox" width="113" height="150"
                                                 src="{{ asset($staff->image) }}" alt="User Image">
                                        @endif
                                    </div>
                                    <div class="upload-img col-md-2">
                                        <div class="change-photo-btn">
                                            <label for="image">
                                                <input type="file" name="image"
                                                       class="@error('email') is-invalid @enderror"
                                                       onchange="document.getElementById('imagebox').src = window.URL.createObjectURL(this.files[0])"
                                                       id="image"><i class="fa fa-upload"></i>
                                                Upload Photo
                                            </label>
                                        </div>
                                        <small class="form-text text-muted">Allowed JPG, or PNG.Max size of 2MB</small>
                                        @error('image')
                                        <small class="text-danger border">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name', $staff->name) }}">
                                @error('name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <input type="text" name="date_of_birth"
                                       class="form-control @error('date_of_birth') is-invalid @enderror"
                                       value="{{ old('date_of_birth', $staff->date_of_birth) }}">
                                @error('date_of_birth')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email', $staff->email) }}">
                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Personal Number</label>
                                <input type="text" name="personal_number"
                                       class="form-control @error('personal_number') is-invalid @enderror"
                                       value="{{ old('personal_number', $staff->personal_number) }}">
                                @error('personal_number')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="phone"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       value="{{ old('phone', $staff->phone) }}">
                                @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Role</label>
                                <select @if(Auth::guard('staff')->user()->role != 'admin') {{ 'disabled' }}@endif  name="role" class="form-control select @error('role') is-invalid @enderror">

                                    @if(old('role') != null)
                                        <option value="{{ old('role') }}">
                                            @switch(old('role'))
                                                @case(1)
                                                {{ 'Admin' }}
                                                @break
                                                @case(2)
                                                {{ 'Doctor' }}
                                                @break
                                                @case(3)
                                                {{ 'Receptionist' }}
                                                @break
                                                @default
                                                {{ '--Select--' }}
                                            @endswitch
                                        </option>

                                    @elseif($staff->role != null)
                                        @switch($staff->role)
                                            @case('admin')
                                            <option value="1">Admin</option>
                                            <option value="0">--Select--</option>
                                            @break
                                            @case('doctor')
                                            <option value="2">Doctor</option>
                                            <option value="0">--Select--</option>
                                            @break
                                            @case('receptionist')
                                            <option value="3">Receptionist</option>
                                            <option value="0">--Select--</option>
                                            @break
                                            @default
                                            <option value="0">--Select--</option>
                                        @endswitch
                                    @else
                                        <option value="0">--Select--</option>
                                    @endif
                                    <option value="3">Receptionist</option>
                                    <option value="2">Doctor</option>
                                    <option value="1">Admin</option>
                                </select>
                                @error('role')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>


                        <div class="col-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address"
                                       class="form-control @error('address') is-invalid @enderror"
                                       value="{{ old('address', $staff->address) }}">
                                @error('address')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" name="city" class="form-control @error('city') is-invalid @enderror"
                                       value="{{ old('city', $staff->city) }}">
                                @error('city')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>State</label>
                                <input type="text" name="state"
                                       class="form-control @error('state') is-invalid @enderror"
                                       value="{{ old('state', $staff->state) }}">
                                @error('state')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="switches">
                            <input type="checkbox" name="isactive"
                                   id="1" @if(old('isactive', $staff->isactive)==1) {{ 'checked' }} @endif/>
                            <label for="1">
                                <span>Account Status &nbsp &nbsp </span>
                                <span></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card my-4">
                <div class="card-title pt-3 pl-3">
                    <h4>About Me</h4>
                </div>
                <div class="card-body pt-0">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Biography</label>
                            <textarea name="biography"
                                      class="form-control @error('biography') is-invalid @enderror">{{ old('biography', $staff->biography) }}</textarea>
                            @error('biography')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="card my-4">
                <div class="card-title pt-3 pl-3">
                    <h4>Services and Specialization <small>(optional)</small></h4>
                </div>
                <div class="card-body pt-0">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Service</label>
                            @php
                                $service = json_decode($staff->service, true);
                                if(!is_array($service)){
                                    $service = array();
                                }
                            @endphp
                            <input type="text" name="service"
                                   class="form-control @error('service') is-invalid @enderror"
                                   value="{{ old('service', array_key_exists('service', $service) ? $service['service']: '') }}">
                            @error('service')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>

                        @php
                            $specialization = json_decode($staff->specialization, true);
                            if(!is_array($specialization)){
                                $specialization = array();
                            }
                        @endphp
                        <div class="form-group">
                            <label>Specialization</label>
                            <input type="text" name="specialization"
                                   class="form-control @error('specialization') is-invalid @enderror"
                                   value="{{ old('specialization', array_key_exists('specialization', $specialization) ? $specialization['specialization'] : '') }}">
                            @error('specialization')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror


                        </div>
                    </div>
                </div>
            </div>

            <div class="card my-4">
                <div class="card-title pt-3 pl-3">
                    <h4>Education</h4>
                </div>
                <div class="card-body pt-0">
                    <div class="col-12">
                        {{--                        @foreach(json_decode($staff->education, true) as $education)--}}

                        @php
                            $education = (json_decode($staff->education, true));
                            if(!is_array($education)){
                            $education = array();
                            }
                        @endphp
                        <div class="row">
                            <div class="col-md-4">
                                <label>Degree</label>
                                <input type="text" name="degree"
                                       class="form-control @error('degree') is-invalid @enderror"
                                       value="{{ old('degree', array_key_exists('degree', $education) ?  $education['degree']:'' ) }}">
                                @error('degree')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label>College/Institut</label>
                                <input type="text" name="college"
                                       class="form-control @error('college') is-invalid @enderror"
                                       value="{{ old('college', array_key_exists('college',$education ) ? $education['college'] : ''  ) }}">
                                @error('college')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label>Year of Completion</label>
                                <input type="text" name="year_of_completion"
                                       class="form-control @error('year_of_completion') is-invalid @enderror"
                                       value="{{ old('year_of_completion', array_key_exists('year_of_completion', $education) ? $education['year_of_completion'] : '') }}">
                                @error('year_of_completion')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        {{--                        @endforeach--}}
                    </div>
                </div>
            </div>


            <div class="submit-section pb-4 pt-1">
                <button type="submit" class="btn btn-primary text-white font-weight-bold">Save Changes</button>
            </div>
        </form>
{{--    </div>--}}
@endsection

@section('js')
    <script>

    </script>
@endsection
