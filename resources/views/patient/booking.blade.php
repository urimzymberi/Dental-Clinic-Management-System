@extends('layouts.user')


@section('css')
    <style>
        .schedule-header table thead div {
            text-align: center;
            padding: 0;
            margin: 0;
            width: 100px;
        }

        .schedule-header table thead td div:first-child {
            font-weight: 500;
            font-size: 20px;
        }

        .schedule-header table tbody td {
            text-align: center;
            background-color: #e9e9e9;
            border: #ffffff solid 5px;
            color: rgba(0, 0, 0, 0.5);
            font-weight: bolder;
        }

        .schedule-header table tbody td button {
            text-align: center;
            width: 100%;
            background-color: #e9e9e9;
            color: rgba(0, 0, 0, 0.5);
            font-weight: bolder;
            border: none;
        }

        .schedule-header table tbody td:first-child, .schedule-header table tbody td:last-child {
            border: none;
            background-color: #ffffff;

        }

        .schedule-header table tbody .timing_selected {
            background-color: #20C0F3;
            color: white;
            font-weight: bolder;
            cursor: not-allowed !important;
        }


        .schedule-header table tbody .notAllowed, .schedule-header table tbody .notAllowedd {
            background-color: #e3342f99;

        }

        .schedule-header table tbody .notAllowed button, .schedule-header table tbody .notAllowedd button {
            color: #e3342f77;
            cursor: not-allowed !important;
        }

    </style>
@endsection

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body row">
                            <div class="booking-doc-info px-3">
                                <a class="booking-doc-img" href="#">
                                    <img alt="User Image" width="113" height="150"
                                         src="{{ $doctor->image != null? asset($doctor->image) : asset('user_images/no-photo.jpg') }}">
                                </a>
                            </div>
                            <div class="booking-info my-auto ">
                                <h4>
                                    <a href="#">{{ $doctor->name }}</a>
                                </h4>
                                <p class="text-muted mb-0"><i class="fas fa-map-marker-alt"></i>{{ $doctor->city }}
                                    , {{ $doctor->state }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col-12 col-sm-4 col-md-6">
                            <h4 id="today_">11 November 2019</h4>
                            <p id="weekday" class="text-muted">Monday</p>
                        </div>
                    </div>
                    <div class="card p-3 booking-schedule schedule-widget">
                        <div class="schedule-header">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="" method="Post">
                                        <table class="col-md-12">
                                            <thead>
                                            <tr>

                                                <td id="left-arrow" onclick="left()">
                                                    <a><i class="fa fa-chevron-left"></i></a>
                                                </td>
                                                <td>
                                                    <div>Mon</div>
                                                    <div class="slot-date">11 Nov 2020</div>
                                                </td>
                                                <td>
                                                    <div>Tue</div>
                                                    <div class="slot-date">12 Nov 2020</div>
                                                </td>
                                                <td>
                                                    <div>Wed</div>
                                                    <div class="slot-date">13 Nov 2020</div>
                                                </td>
                                                <td>
                                                    <div>Thu</div>
                                                    <div class="slot-date">14 Nov 2020</div>
                                                </td>
                                                <td>
                                                    <div>Fri</div>
                                                    <div class="slot-date">15 Nov 2020</div>
                                                </td>
                                                <td>
                                                    <div>Sat</div>
                                                    <div class="slot-date">16 Nov 2020</div>
                                                </td>
                                                {{--                                                <td>--}}
                                                {{--                                                    <div>Sun</div>--}}
                                                {{--                                                    <div class="slot-date">17 Nov 2020</div>--}}
                                                {{--                                                </td>--}}
                                                <td id="right-arrow" onclick="right()">
                                                    <a><i class="fa fa-chevron-right"></i></a>
                                                </td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <button id="_08_1" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">08:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_08_2" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">08:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_08_3" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">08:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_08_4" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">08:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_08_5" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">08:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_08_6" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">08:00
                                                    </button>
                                                </td>
                                                {{--                                                <td class="notAllowed">08:00</td>--}}
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <button id="_09_1" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">09:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_09_2" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">09:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_09_3" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">09:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_09_4" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">09:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_09_5" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">09:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_09_6" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">09:00
                                                    </button>
                                                </td>
                                                {{--                                                <td class="notAllowed">09:00</td>--}}
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <button id="_10_1" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">10:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_10_2" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">10:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_10_3" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">10:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_10_4" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">10:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_10_5" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">10:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_10_6" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">10:00
                                                    </button>
                                                </td>
                                                {{--                                                <td class="notAllowed">10:00</td>--}}
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <button id="_11_1" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">11:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_11_2" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">11:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_11_3" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">11:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_11_4" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">11:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_11_5" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">11:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_11_6" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">11:00
                                                    </button>
                                                </td>
                                                {{--                                                <td class="notAllowed">11:00</td>--}}
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td class="notAllowedd">
                                                    <button id="_12_1" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">12:00
                                                    </button>
                                                </td>
                                                <td class="notAllowedd">
                                                    <button id="_12_1" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">12:00
                                                    </button>
                                                </td>
                                                <td class="notAllowedd">
                                                    <button id="_12_1" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">12:00
                                                    </button>
                                                </td>
                                                <td class="notAllowedd">
                                                    <button id="_12_1" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">12:00
                                                    </button>
                                                </td>
                                                <td class="notAllowedd">
                                                    <button id="_12_1" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">12:00
                                                    </button>
                                                </td>
                                                <td class="notAllowedd">
                                                    <button id="_12_1" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">12:00
                                                    </button>
                                                </td>
                                                {{--                                                <td class="notAllowed">12:00</td>--}}
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <button id="_13_1" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">13:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_13_2" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">13:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_13_3" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">13:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_13_4" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">13:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_13_5" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">13:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_13_6" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">13:00
                                                    </button>
                                                </td>
                                                {{--                                                <td class="notAllowed">13:00</td>--}}
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <button id="_14_1" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">14:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_14_2" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">14:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_14_3" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">14:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_14_4" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">14:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_14_5" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">14:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_14_6" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">14:00
                                                    </button>
                                                </td>
                                                {{--                                                <td class="notAllowed">14:00</td>--}}
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <button id="_15_1" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">15:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_15_2" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">15:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_15_3" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">15:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_15_4" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">15:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_15_5" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">15:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_15_6" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">15:00
                                                    </button>
                                                </td>
                                                {{--                                                <td class="notAllowed">15:00</td>--}}
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <button id="_16_1" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">16:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_16_2" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">16:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_16_3" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">16:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_16_4" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">16:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_16_5" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">16:00
                                                    </button>
                                                </td>
                                                <td>
                                                    <button id="_16_6" type="button" data-toggle="modal"
                                                            data-target="#myModal" onclick="modal_data(this.id)">16:00
                                                    </button>
                                                </td>
                                                {{--                                                <td class="notAllowed">16:00</td>--}}
                                                <td></td>
                                            </tr>
                                            {{--                                            <tr>--}}
                                            {{--                                                <td></td>--}}
                                            {{--                                                <td>--}}
                                            {{--                                                    <button id="_17_1" type="button" data-toggle="modal"--}}
                                            {{--                                                            data-target="#myModal">17:00--}}
                                            {{--                                                    </button>--}}
                                            {{--                                                </td>--}}
                                            {{--                                                <td>--}}
                                            {{--                                                    <button id="_17_2" type="button" data-toggle="modal"--}}
                                            {{--                                                            data-target="#myModal">17:00--}}
                                            {{--                                                    </button>--}}
                                            {{--                                                </td>--}}
                                            {{--                                                <td>--}}
                                            {{--                                                    <button id="_17_3" type="button" data-toggle="modal"--}}
                                            {{--                                                            data-target="#myModal">17:00--}}
                                            {{--                                                    </button>--}}
                                            {{--                                                </td>--}}
                                            {{--                                                <td>--}}
                                            {{--                                                    <button id="_17_4" type="button" data-toggle="modal"--}}
                                            {{--                                                            data-target="#myModal">17:00--}}
                                            {{--                                                    </button>--}}
                                            {{--                                                </td>--}}
                                            {{--                                                <td>--}}
                                            {{--                                                    <button id="_17_5" type="button" data-toggle="modal"--}}
                                            {{--                                                            data-target="#myModal">17:00--}}
                                            {{--                                                    </button>--}}
                                            {{--                                                </td>--}}
                                            {{--                                                <td>--}}
                                            {{--                                                    <button id="_17_6" type="button" data-toggle="modal"--}}
                                            {{--                                                            data-target="#myModal">17:00--}}
                                            {{--                                                    </button>--}}
                                            {{--                                                </td>--}}
                                            {{--                                                --}}{{--                                                <td class="notAllowed">17:00</td>--}}
                                            {{--                                                <td></td>--}}
                                            {{--                                            </tr>--}}
                                            {{--                                            <tr>--}}
                                            {{--                                                <td></td>--}}
                                            {{--                                                <td>--}}
                                            {{--                                                    <button id="_18_1" type="button" data-toggle="modal"--}}
                                            {{--                                                            data-target="#myModal">18:00--}}
                                            {{--                                                    </button>--}}
                                            {{--                                                </td>--}}
                                            {{--                                                <td>--}}
                                            {{--                                                    <button id="_18_2" type="button" data-toggle="modal"--}}
                                            {{--                                                            data-target="#myModal">18:00--}}
                                            {{--                                                    </button>--}}
                                            {{--                                                </td>--}}
                                            {{--                                                <td>--}}
                                            {{--                                                    <button id="_18_3" type="button" data-toggle="modal"--}}
                                            {{--                                                            data-target="#myModal">18:00--}}
                                            {{--                                                    </button>--}}
                                            {{--                                                </td>--}}
                                            {{--                                                <td>--}}
                                            {{--                                                    <button id="_18_4" type="button" data-toggle="modal"--}}
                                            {{--                                                            data-target="#myModal">18:00--}}
                                            {{--                                                    </button>--}}
                                            {{--                                                </td>--}}
                                            {{--                                                <td>--}}
                                            {{--                                                    <button id="_18_5" type="button" data-toggle="modal"--}}
                                            {{--                                                            data-target="#myModal">18:00--}}
                                            {{--                                                    </button>--}}
                                            {{--                                                </td>--}}
                                            {{--                                                <td>--}}
                                            {{--                                                    <button id="_18_6" type="button" data-toggle="modal"--}}
                                            {{--                                                            data-target="#myModal">18:00--}}
                                            {{--                                                    </button>--}}
                                            {{--                                                </td>--}}
                                            {{--                                                --}}{{--                                                <td class="notAllowed">18:00</td>--}}
                                            {{--                                                <td></td>--}}
                                            {{--                                            </tr>--}}
                                            {{--                                            <tr>--}}
                                            {{--                                                <td></td>--}}
                                            {{--                                                <td>--}}
                                            {{--                                                    <button id="_19_1" type="button" data-toggle="modal"--}}
                                            {{--                                                            data-target="#myModal">19:00--}}
                                            {{--                                                    </button>--}}
                                            {{--                                                </td>--}}
                                            {{--                                                <td>--}}
                                            {{--                                                    <button id="_19_2" type="button" data-toggle="modal"--}}
                                            {{--                                                            data-target="#myModal">19:00--}}
                                            {{--                                                    </button>--}}
                                            {{--                                                </td>--}}
                                            {{--                                                <td>--}}
                                            {{--                                                    <button id="_19_3" type="button" data-toggle="modal"--}}
                                            {{--                                                            data-target="#myModal">19:00--}}
                                            {{--                                                    </button>--}}
                                            {{--                                                </td>--}}
                                            {{--                                                <td>--}}
                                            {{--                                                    <button id="_19_4" type="button" data-toggle="modal"--}}
                                            {{--                                                            data-target="#myModal">19:00--}}
                                            {{--                                                    </button>--}}
                                            {{--                                                </td>--}}
                                            {{--                                                <td>--}}
                                            {{--                                                    <button id="_19_5" type="button" data-toggle="modal"--}}
                                            {{--                                                            data-target="#myModal">19:00--}}
                                            {{--                                                    </button>--}}
                                            {{--                                                </td>--}}
                                            {{--                                                <td>--}}
                                            {{--                                                    <button id="_19_6" type="button" data-toggle="modal"--}}
                                            {{--                                                            data-target="#myModal">19:00--}}
                                            {{--                                                    </button>--}}
                                            {{--                                                </td>--}}
                                            {{--                                                --}}{{--                                                <td class="notAllowed">19:00</td>--}}
                                            {{--                                                <td></td>--}}
                                            {{--                                            </tr>--}}
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <form action="{{ route('patient.save_appointment') }}" method="Post">
                                @csrf
                                <input type="hidden" name="date_time" id="date_time">
                                <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <p class="modal-title"><i
                                                class="fa fa-exclamation-circle text-primary fa-4x"></i></p>
                                        <h3>Confirm appointment!</h3>
                                        <p>Appointment booked with
                                            <strong>{{ $doctor->name }}</strong>
                                            <br>
                                            on
                                            <strong id="confirm_date">12 Nov 2020 5:00PM to 6:00PM</strong>
                                        </p>
                                        <label for="description">Description:</label>
                                        <textarea name="description" id="description" cols="50" rows="3"></textarea>
                                        <br>
                                        <input type="submit" class="btn btn-primary" value="Confirm">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]
        var curr = new Date();
        var start = 0;
        var slot_date = document.getElementsByClassName("slot-date");
        var appts_dates = @php echo json_encode($appt_date); @endphp;

        date_now();
        date_week();
        valide_day();
        timing_selected();

        function date_now() {
            var dd1 = curr.getDate();
            var mm1 = curr.getMonth() + 1;
            var yyyy1 = curr.getFullYear();
            document.getElementById('today_').innerHTML = dd1 + '-' + mm1 + '-' + yyyy1;
            document.getElementById('weekday').innerHTML = weekday[curr.getDay()];
        }

        function date_week() {
            for (var i = 0; i < slot_date.length; i++) {
                var d = Date.parse(curr);
                var _date = d + (86400000 * (i + 1 - curr.getDay()));
                var dddd = new Date(_date);
                var dd = dddd.getDate();
                var mm = dddd.getMonth() + 1;
                var yyyy = dddd.getFullYear();
                slot_date[i].innerHTML = dd + '/' + mm + '/' + yyyy;
            }
        }

        function timing_selected() {
            var test = 7 - curr.getDay();

            for (var j = 0; j < appts_dates.length; j++) {

                if (1000 * appts_dates[j] >= Date.parse(curr) + 86400000 * (start - curr.getDay()) && 1000 * appts_dates[j] <= Date.parse(curr) + 86400000 * (start + 7 - curr.getDay())) {
                    var r = new Date(1000 * appts_dates[j]);
                    var day = r.getDay();
                    var hour = r.getHours() - 1;
                    var class_name = '_' + (parseInt(hour) <= parseInt(9) ? '0' + hour : hour) + '_' + day;
                    document.getElementById(class_name).classList.add("timing_selected");
                    document.getElementById(class_name).disabled = "disabled";
                }
            }
        }

        function left() {
            var d = Date.parse(curr);
            if (start >= 7) {
                clear_class();
                start = start - 7;
                for (var i = 0; i < slot_date.length; i++) {
                    var _date = d + (86400000 * (i + start + 1 - curr.getDay()));
                    var dddd = new Date(_date);
                    var dd = dddd.getDate();
                    var mm = dddd.getMonth() + 1;
                    var yyyy = dddd.getFullYear();
                    slot_date[i].innerHTML = dd + '/' + mm + '/' + yyyy;
                }
                timing_selected();
                valide_day();
            }
        }

        function right() {
            var d = Date.parse(curr);
            start = start + 7;
            for (var i = 0; i < slot_date.length; i++) {
                var _date = d + (86400000 * (i + start + 1 - curr.getDay()));
                var dddd = new Date(_date);
                var dd = dddd.getDate();
                var mm = dddd.getMonth() + 1;
                var yyyy = dddd.getFullYear();
                slot_date[i].innerHTML = dd + '/' + mm + '/' + yyyy;
            }
            clear_class();
            timing_selected();
        }

        function modal_data(clicked_id) {

            var hour_selscted = clicked_id.substring(1, 3);
            var day_selscted = parseInt(clicked_id.substring(4));


            var date_parse = Date.parse(curr); //i + start + 1-curr.getDay())
            var duz = date_parse + (86400000 * (start + day_selscted - curr.getDay()))
            var date_selected = new Date(duz);

            var date_appt = date_selected.getDate();
            var month_appt = date_selected.getMonth() + 1;
            var year_appt = date_selected.getFullYear();

            document.getElementById('confirm_date').innerHTML = date_appt + '/' + month_appt + '/' + year_appt + ' ' + parseInt(hour_selscted) + ':00 to ' + (parseInt(hour_selscted) + 1) + ':00';
            document.getElementById('date_time').value = year_appt + '-' + month_appt + '-' + date_appt + ' ' + hour_selscted + ':00:00';
        }


        function valide_day() {

            var allElements = document.querySelectorAll('[id^="_"]');

            for (var i = 0; i < allElements.length; i++) {

                var idElement = allElements[i].id;
                var element_hour = parseInt(idElement.substring(1, 3));
                var element_day = parseInt(idElement.substring(4));

                var hour = parseInt(curr.getHours());
                var day = parseInt(curr.getDay());

                if (start == 0) {
                    if (element_day < day || (element_day == day && element_hour <= hour)) {
                        allElements[i].parentNode.classList.add("notAllowed");
                        allElements[i].disabled = "disabled";
                    }
                }
            }
        }


        function clear_class() {
            var element_timing_selected = document.getElementsByClassName('timing_selected');
            for (var i = 0; i < element_timing_selected.length; i++) {
                element_timing_selected[i].disabled = false;
                element_timing_selected[i].classList.remove('timing_selected');
            }
            var valide_day = document.getElementsByClassName('notAllowed');
            for (var j = 0; j < valide_day.length; j++) {
                valide_day[j].childNodes[1].disabled = false;
                valide_day[j].classList.remove('notAllowed');
            }
            element_timing_selected = document.getElementsByClassName('timing_selected');
            valide_day = document.getElementsByClassName('notAllowed');
            if (element_timing_selected.length > 0 || valide_day.length > 0) {
                clear_class();
            }
        }
    </script>
@endsection

