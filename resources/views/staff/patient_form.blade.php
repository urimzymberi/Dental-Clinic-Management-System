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

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="post" enctype="multipart/form-data" action="{{ route('staff.submit_patient_form') }}">
            @csrf
            <div class="card my-4">
                <div class="card-title pt-3 pl-3">
                    <h4>Basic Information</h4>
                </div>
                <div class="card-body pt-0">
                    <input type="hidden" name="id" value="{{ $patient->id  }}">
                    <div class="row form-row">

                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name', $patient->name) }}">
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
                                       value="{{ old('date_of_birth', $patient->date_of_birth) }}">
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
                                       value="{{ old('email', $patient->email) }}">
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
                                       value="{{ old('personal_number', $patient->personal_number) }}">
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
                                       value="{{ old('phone', $patient->phone) }}">
                                @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address"
                                       class="form-control @error('address') is-invalid @enderror"
                                       value="{{ old('address', $patient->address) }}">
                                @error('address')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" name="city" class="form-control @error('city') is-invalid @enderror"
                                       value="{{ old('city', $patient->city) }}">
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
                                       value="{{ old('state', $patient->state) }}">
                                @error('state')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="switches">
                            <input type="checkbox" name="isactive"
                                   id="1" {{ old('isactive', $patient->isactive==1?'checked':'') }}/>
                            <label for="1">
                                <span>Account Status &nbsp &nbsp </span>
                                <span></span>
                            </label>
                        </div>
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
