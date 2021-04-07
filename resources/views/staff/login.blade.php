@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center p-5">
                <div class="card w-50 p-5">
                    {{--                    <div>--}}
                    {{--                        <h3>Login</h3><br>--}}
                    {{--                    </div>--}}
                    {{--                    <div>--}}
                    {{--                        <form method="POST" action="{{ route('staff.submit_login') }}">--}}
                    {{--                            @csrf--}}
                    {{--                            <div>--}}
                    {{--                                <input type="text" name="email" id="email" placeholder="Email...">--}}
                    {{--                            </div>--}}
                    {{--                            <div>--}}
                    {{--                                <input type="text" name="password" id="password" placeholder="Password">--}}
                    {{--                            </div>--}}
                    {{--                            <div>--}}
                    {{--                                <input type="submit" value="Login">--}}
                    {{--                            </div>--}}
                    {{--                        </form>--}}
                    {{--                    </div>--}}


                    <div class="row">
                        <div class="w-100">
                            <form class="form-horizontal contro" action='{{ route('check') }}' method="POST">
                                @csrf
                                <fieldset>
                                    <div id="legend">
                                        <legend class="">Login To Account</legend>
                                    </div>
                                    <hr>
                                    <div class="control-group">
                                        <div class="controls">
                                            <input type="hidden" name="staff_patient" id="staf-patient"
                                                   class="form-control" value="staff">
                                            <input type="text" id="email" name="email" placeholder="Email..."
                                                   class="form-control my-3">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="controls">
                                            <input type="password" id="password" name="password"
                                                   placeholder="Password..." class="form-control my-3">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="controls d-flex justify-content-end">
                                            <button class="btn btn-primary my-2 w-25">Login</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
