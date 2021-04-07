<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class PatientController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('patient_id', Auth::guard('patient')->user()->id)->orderBy('id', 'desc')->paginate(8);
        return view('patient.dashboard', compact('appointments'));
    }

    public function patientProfile()
    {
        $id = Auth::guard('patient')->user()->id;
        $patient = Patient::findOrFail($id);
        $appointments = Appointment::where('patient_id', $patient->id)->orderBy('id', 'desc')->with('staff')->paginate(8);

        return view('patient.patient_profile', compact('patient', 'appointments'), ['page_title' => 'Patient Profile']);
    }

    public function patient_form()
    {
        $id = null;
        if (Auth::guard('patient')->check()) {
            $id = Auth::guard('patient')->user()->id;
        }
        if ($id != null) {
            $patient = Patient::findOrFail($id);
        } else {
            $patient = (object)[
                'id' => 0,
                'isactive' => 1,
                'name' => '',
                'date_of_birth' => '',
                'email' => '',
                'personal_number' => '',
                'phone' => '',
                'address' => '',
                'city' => '',
                'state' => 'Kosove',
            ];
        }
        return view('patient.patient_form', compact('patient'));
    }

    public function submit_patient_form(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:50|string',
            'email' => 'required|max:100|string|unique:staff,email',
            'personal_number' => 'required|numeric|digits:10',
            'phone' => 'required|max:20',
            'date_of_birth' => 'required|date_format:Y-m-d',/*date_format:d/m/Y*/
            'address' => 'required|max:255',
            'city' => 'required|max:20',
            'state' => 'required|max:20',
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $personal_number = filter_var($request->input('personal_number'), FILTER_SANITIZE_NUMBER_INT);
        $phone = filter_var($request->input('phone'), FILTER_SANITIZE_STRING);
        $date_of_birth = filter_var($request->input('date_of_birth'), FILTER_SANITIZE_STRING);
        $address = filter_var($request->input('address'), FILTER_SANITIZE_STRING);
        $city = filter_var($request->input('city'), FILTER_SANITIZE_STRING);
        $state = filter_var($request->input('state'), FILTER_SANITIZE_STRING);

        $id = $request->input('id');
        if ($id != 0) {
            $patient = Patient::findOrFail($id);
        } else {
            $password = Hash::make(filter_var($request->input('personal_number'), FILTER_SANITIZE_NUMBER_INT));
            $patient = new Patient();
            $patient->password = $password;
        }


        if (Auth::guard('staff')->check() || Auth::guard('patient')->check()) {
            $patient->isactive = $request->has('isactive') ? 1 : 0;
        } else {
            $patient->isactive = 1;
        }

        $patient->name = $name;
        $patient->email = $email;
        $patient->personal_number = $personal_number;
        $patient->phone = $phone;
        $patient->date_of_birth = $date_of_birth;
        $patient->address = $address;
        $patient->city = $city;
        $patient->state = $state;


        if (Auth::guard('staff')->check() || Auth::guard('patient')->check()) {
            if ($patient->save()) {
                toast('Patient successfully updated!', 'success');
            } else {
                toast('Patient failed to update!', 'error');
            }
            return redirect('patient/profile');
        } else {
            if ($patient->save()) {
                toast('Patient successfully created!', 'success');
            } else {
                toast('Psatient failed to created!', 'error');
            }
            return redirect('plogin');
        }
    }

    public function change_password(Request $request)
    {

        $request->validate([
            ['old_password' => 'required|string'],
            ['password' => 'required|confirmed|min:6']
        ]);

        $id = Auth::guard('patient')->user()->id;
        $old_password = filter_var($request->input('old_password'), FILTER_SANITIZE_STRING);
        $password = filter_var($request->input('password'), FILTER_SANITIZE_STRING);

        if (Auth::guard('patient')->attempt([
            'id' => $id,
            'password' => $old_password
        ])) {
            $patient = Patient::findOrFail($id);
            $patient->password = Hash::make($password);

            if ($patient->save()) {
                toast('User successfully updated!', 'success');
            } else {
                toast('User failed update!', 'error');
            }
        } else {
            toast('User failed update!', 'error');
        }
        return redirect()->route('patient.profile');
    }

    public function doctors()
    {
        $doctors = Staff::where([
            ['role', '=', 'doctor'],
            ['isactive', '=', 1]
        ])->get();

        return view('patient.doctors', compact('doctors'));
    }

    public function doctorProfile($id)
    {
        $doctor = Staff::where([
            ['role', '=', 'doctor'],
            ['isactive', '=', 1]
        ])->findOrFail($id);
        return view('patient.doctor_profile', compact('doctor'));
    }

    public function booking($id)
    {
        $doctor = Staff::where('role', 'doctor')->findOrFail($id);
        $appointments_date = $doctor->appointments()->where([
            ['status', '!=', 2],
            ['status', '!=', 3],
            ['appointment_date_time', '>=', date("Y-m-d H:i:s")],
        ])->get('appointment_date_time');
        $appt_date = [];
        foreach ($appointments_date as $appointment_date) {

            $appt_date[] = strtotime($appointment_date->appointment_date_time);
        }
        return view('patient.booking', compact('doctor'), compact('appt_date'));
    }


    public function saveAppointment(Request $request)
    {

        $validateData = $request->validate([
            'description' => 'required|min:20|string',
            'doctor_id' => 'required|numeric',
            'date_time' => 'required|string'
        ]);

        $description = filter_var($request->input('description'), FILTER_SANITIZE_STRING);
        $doctor_id = filter_var($request->input('doctor_id'), FILTER_SANITIZE_NUMBER_INT);
        $date_appt = $request->input('date_time');

        $appointment = new Appointment();
        $appointment->number = '00000';
        $appointment->staff_id = $doctor_id;
        $appointment->patient_id = Auth::guard('patient')->user()->id;
        $appointment->status = 0;
        $appointment->appointment_date_time = $date_appt;
        $appointment->description = $description;


        $appt_count_by_doc = Appointment::where([
            ['staff_id', '=', $doctor_id],
            ['status', '!=', 2],
            ['status', '!=', 3],
            ['appointment_date_time', '=', $date_appt]
        ])->count();

        if (!$appt_count_by_doc > 0) {
            if ($appointment->save()) {
                $appointment->number = str_pad($appointment->id, 5, '0', STR_PAD_LEFT);
                $appointment->save();
                toast('Appointment successfull save!', 'success');
            } else {
                toast('Appointment failed save!', 'error');
            }
        } else {
            toast('Appointment failed save!', 'error');
        }

        return redirect()->route('patient.doctors');
    }

    public function home()
    {
        $doctors = Staff::where([
            ['role', '=', 'doctor'],
            ['isactive', '=', 1]
        ])->inRandomOrder()->take(3)->get();
        return view('home')->with(compact('doctors'));
    }

}
