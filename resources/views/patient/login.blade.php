@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center p-5">
                <div class="card w-50 p-5">

                    <div class="row">
                        <div class="w-100">
                            <form class="form-horizontal contro" action='{{ route('check') }}' method="POST">
                                @csrf
                                <fieldset>
                                    <div id="legend">
                                        <legend class="">Login Patient</legend>
                                    </div>
                                    <hr>
                                    <div class="control-group">
                                        <div class="controls">
                                            <input type="hidden" name="staff_patient" id="staf-patient"
                                                   class="form-control" value="patient">
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
                                        <div class="controls d-flex justify-content-center">
                                            <button class="btn btn-primary my-2 w-75">Login</button>
                                        </div>
                                    </div>
                                    <div class="text-center dont-have">Don’t have an account?
                                        <a href="{{ asset("patinet_form") }}">Register</a>
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
