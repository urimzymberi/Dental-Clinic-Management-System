<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Staff;
use Faker\Provider\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    public function index()
    {
        $doctors = Staff::where([
            ['role', '=', 'doctor'],
            ['isactive', '=', 1]
        ])->orderBy('id', 'desc')->take(5)->get();

        $doctor_count = Staff::where([
            ['role', '=', 'doctor'],
            ['isactive', '=', 1]
        ])->count();

        $receptionist_count = Staff::where([
            ['role', '=', 'receptionist'],
            ['isactive', '=', 1]
        ])->count();

        $patients = Patient::where('isactive', 1)->orderBy('id', 'desc')->take(5)->get();

        $patient_count = Patient::count();

        $appointments = Appointment::orderBy('id', 'desc')->take(5)->with('staff')->with('patient')->get();

        $appointment_count = Appointment::count();

        return view('staff.dashboard')
            ->with(['page_title' => 'Dashboard'])
            ->with(compact('doctors'))
            ->with(compact('doctor_count'))
            ->with(compact('receptionist_count'))
            ->with(compact('patients'))
            ->with(compact('patient_count'))
            ->with(compact('appointments'))
            ->with(compact('appointment_count'));
    }

    public function staffForm($id = null)
    {
        if ($id != null && (Auth::guard('staff')->user()->role == 'admin' || Auth::guard('staff')->user()->id == $id)) {
            $staff = Staff::findOrFail($id);
            $page_title = 'Edit User';
        } else {
            $staff = (object)[
                'id' => 0,
                'role' => '',
                'isactive' => 0,
                'name' => '',
                'email' => '',
                'personal_number' => '',
                'phone' => '',
                'date_of_birth' => '',
                'image' => '',
                'biography' => '',
                'address' => '',
                'city' => '',
                'state' => 'Kosove',
                'education' => '',
                'experience' => '',
                'service' => '',
                'specialization' => '',
            ];
            $page_title = 'New User';
        }
        return view('staff.staff_form', compact('staff'), ['page_title' => $page_title]);
    }

    public function submitStaffForm(Request $request)
    {
        $id = $request->input('id');

        if ($id != '0') {
            $test = 1;
            $validatedData = $request->validate([
                'name' => 'required|max:50|string',
                'email' => 'required|max:100|string',
                'personal_number' => 'required|numeric|digits:10',
                'phone' => 'required|max:20',
                'date_of_birth' => 'required|date_format:Y-m-d',/*date_format:d/m/Y*/
                'biography' => '',
                'address' => 'required|max:255',
                'city' => 'required|max:20',
                'state' => 'required|max:20',
                'degree' => '',
                'college' => '',
                'year_of_completion' => '',
                'service' => '',
                'specialization' => '',
            ]);
        } else {
            $test = 1;
            $validatedData = $request->validate([
                'role' => 'required|numeric|max:3|min:1',
                'name' => 'required|max:50|string',
                'email' => 'required|max:100|string|unique:staff,email',
                'personal_number' => 'required|numeric|digits:10',
                'phone' => 'required|max:20',
                'date_of_birth' => 'required|date_format:Y-m-d',/*date_format:d/m/Y*/
                'image' => 'required|image',
                'biography' => '',
                'address' => 'required|max:255',
                'city' => 'required|max:20',
                'state' => 'required|max:20',
                'degree' => '',
                'college' => '',
                'year_of_completion' => '',
                'service' => '',
                'specialization' => '',
            ]);
        }

        $role = filter_var($request->input('role'), FILTER_SANITIZE_NUMBER_INT);
        $name = $request->input('name');
        $email = $request->input('email');
        $personal_number = filter_var($request->input('personal_number'), FILTER_SANITIZE_NUMBER_INT);
        $phone = filter_var($request->input('phone'), FILTER_SANITIZE_STRING);
        $date_of_birth = filter_var($request->input('date_of_birth'), FILTER_SANITIZE_STRING);
        $biography = filter_var($request->input('biography'), FILTER_SANITIZE_STRING);
        $address = filter_var($request->input('address'), FILTER_SANITIZE_STRING);
        $city = filter_var($request->input('city'), FILTER_SANITIZE_STRING);
        $state = filter_var($request->input('state'), FILTER_SANITIZE_STRING);
        $degree = filter_var($request->input('degree'), FILTER_SANITIZE_STRING);
        $college = filter_var($request->input('college'), FILTER_SANITIZE_STRING);
        $year_of_completion = filter_var($request->input('year_of_completion'), FILTER_SANITIZE_STRING);
        $service = filter_var($request->input('service'), FILTER_SANITIZE_STRING);
        $specialization = filter_var($request->input('specialization'), FILTER_SANITIZE_STRING);
        $path = 'user_images/no-photo.jpg';

        if ($id != 0 || $id = null) {
            $staff = Staff::findOrFail($id);
            $path = $staff->image;
        } else {
            if ($this->middleware('is_admin') && $id == null) {
                $password = Hash::make(filter_var($request->input('personal_number'), FILTER_SANITIZE_NUMBER_INT));
                $staff = new Staff();
                $staff->password = $password;
            } else {
                echo 'You are not an administrator to add a staff!';
            }
        }

        switch ($role) {
            case 1:
                $role = 'admin';
                break;

            case 2:
                $role = 'doctor';
                break;

            case 3:
                $role = 'receptionist';
                break;
        }


        if ($request->file('image') != null) {
            if ($path != 'user_images/no-photo.jpg') {
                Storage::delete($path);
            }
            $path = $request->file('image')->store('user_images');
        }


        $education['degree'] = $degree;
        $education['college'] = $college;
        $education['year_of_completion'] = $year_of_completion;
        $json_education = json_encode($education);

        $experience = null;

        $service_['service'] = $service;
        $json_service = json_encode($service_);


        $specialization_['specialization'] = $specialization;
        $json_specialization = json_encode($specialization_);

        if (Auth::guard('staff')->user()->role == 'admin') {
            $staff->role = $role;
        }
        $staff->isactive = $request->has('isactive') ? 1 : 0;
        $staff->name = $name;
        $staff->email = $email;
        $staff->personal_number = $personal_number;
        $staff->phone = $phone;
        $staff->date_of_birth = $date_of_birth;
        $staff->image = $path;
        $staff->biography = $biography;
        $staff->address = $address;
        $staff->city = $city;
        $staff->state = $state;
        $staff->education = $json_education;
        $staff->experience = $experience;
        $staff->service = $json_service;
        $staff->specialization = $json_specialization;

        if (Auth::guard('staff')->user()->role == 'admin' && $id == null) {
            //create
            if ($staff->save()) {
                toast('User successfull created!', 'success');
                return redirect(route('staff.profile', [$staff->id]));
            } else {
                toast('User failed create!', 'error');
                return redirect(route('staff.profile', [$staff->id]));
            }
        } else {
            //update
            if ($staff->save()) {
                toast('User successfull updated', 'success');
                return redirect(route('staff.profile', [$id]));
            } else {
                toast('User failed update', 'error');
                return redirect(route('staff.profile', [$id]));
            }
        }
    }


    public function profile($id = null)
    {
        $staff = Staff::findOrFail($id);

        return view('staff.profile', compact('staff'), ['page_title' => 'Profile']);
    }


    public function change_password(Request $request)
    {

        $request->validate([
            ['old_password' => 'required|string'],
            ['password' => 'required|confirmed|min:6']
        ]);

        $id = Auth::guard('staff')->user()->id;
        $old_password = filter_var($request->input('old_password'), FILTER_SANITIZE_STRING);
        $password = filter_var($request->input('password'), FILTER_SANITIZE_STRING);

        if (Auth::guard('staff')->attempt([
            'id' => $id,
            'password' => $old_password
        ])) {
            $staff = Staff::findOrFail($id);
            $staff->password = Hash::make($password);
            if ($staff->save()) {
                toast('User successful updated!', 'success');
            } else {
                toast('User failed update!', 'error');
            }
        } else {
            toast('User failed update!', 'error');
        }
        return redirect()->route('staff.profile', [$id]);
    }

    public function appointments()
    {
        if (Auth::guard('staff')->user()->role != 'doctor') {
            $appointments = Appointment::orderBy('id', 'desc')->with('staff', 'patient')->paginate(8);
        } elseif (Auth::guard('staff')->user()->role == 'doctor') {
            $appointments = Appointment::where('staff_id', Auth::guard('staff')->user()->id)->orderBy('id', 'desc')->with('staff')->paginate(8);
        } else {
            $appointments = Appointment::where('patient_id', Auth::guard('patients')->user()->id)->orderBy('id', 'desc')->paginate(8);
        }

        $doctors = Staff::where('role', 'doctor')
            ->get(['id', 'name']);

        return view('staff.appointments')
            ->with( compact('appointments'))
            ->with( compact('doctors'))
            ->with(['page_title' => 'Appointments']);
    }

    public function search_appointments(Request $request)
    {
        $doctor_id = filter_var($request->input('doctor'), FILTER_SANITIZE_NUMBER_INT);
        $patient_name = trim(filter_var($request->input('patient'), FILTER_SANITIZE_STRING));
        $status = filter_var($request->input('status'), FILTER_SANITIZE_NUMBER_INT);

        $patient_id = Patient::where('name', 'like', "%" . $patient_name . "%")->pluck('id')->toArray();
        if (Auth::guard('staff')->user()->role != 'doctor') {
            $appointments = Appointment::with('staff', 'patient')
                ->when($doctor_id, function ($query, $doctor_id) {
                    return $query->where('staff_id', $doctor_id);
                })
                ->when($status, function ($query, $status) {
                    return $query->where('status', $status);
                })
                ->when($patient_id, function ($query, $patient_id) {
                    return $query->where('patient_id', $patient_id);
                })
                ->with('staff', 'patient')
                ->paginate(8)->withQueryString();

        } else {
            $appointments = Appointment::with('staff', 'patient')
                ->when($doctor_id, function ($query, $doctor_id) {
                    return $query->where('staff_id', $doctor_id);
                })
                ->when($status, function ($query, $status) {
                    return $query->where('status', $status);
                })
                ->when($patient_id, function ($query, $patient_id) {
                    return $query->where('patient_id', $patient_id);
                })
                ->with('staff', 'patient')
                ->where('staff_id', Auth::guard('staff')->user()->id)
                ->paginate(8)->withQueryString();
        }

        $doctors = Staff::where('role', 'doctor')
            ->get(['id', 'name']);

        return view('staff.appointments')
            ->with('appointments', $appointments)
            ->with('doctors', $doctors)
            ->with(['page_title' => 'Appointments'])
            ->with(['doctor_id' => $doctor_id])
            ->with(['status' => $status])
            ->with(['search_patient_name' => $patient_name]);
    }

    public function submitEditAppointmentStatus(Request $request)
    {

        $validatedData = $request->validate([
            ['id' => 'required|numeric'],
            ['status' => 'required|numeric'],
        ]);

        $id = filter_var($request->input('id'), FILTER_SANITIZE_NUMBER_INT);
        $status = filter_var($request->input('status'), FILTER_SANITIZE_NUMBER_INT);
        $appointment = Appointment::findOrFail($id);
        $appointment->status = $status;
        if ($appointment->save()) {
            toast('Status changed successfull!', 'success');
            return redirect(asset('staff/appointments'));
        } else {
            toast('Status change failed!', 'error');
            return redirect(asset('staff/appointments'));
        }
    }
//
//    public function doctors()
//    {
//        $doctors = Staff::where('role', 'doctor')->orderBy('id', 'desc')->paginate(12);
//        return view('staff.admin.doctors', compact('doctors'), ['page_title'=>'Doctors']);
//    }

    public function patients()
    {
        if (Auth::guard('staff')->user()->role != 'doctor') {
            $patients = Patient::orderBy('id', 'desc')->paginate(12);
        } else {
            $patients = DB::table('appointments')
                ->join('patients', 'appointments.patient_id', 'patients.id')
                ->where('appointments.staff_id', Auth::guard('staff')->user()->id)
                ->groupBy('patients.id')
                ->select('patients.*')
                ->paginate(8);
        }
        return view('staff.patients', ['patients' => $patients], ['page_title' => 'Patients']);
    }

    public function patientForm($id = null)
    {
        if ($id != null) {
            $patient = Patient::findOrFail($id);
            $page_title = 'Edit Patient';
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
            $page_title = 'New Patient';
        }
        return view('staff.patient_form', compact('patient'), ['page_title' => $page_title]);
    }

    public function patientProfile($id = null)
    {
        $patient = Patient::findOrFail($id);
        $appointments = Appointment::where('patient_id', $patient->id)->orderBy('id', 'desc')->with('staff')->paginate(8);
        return view('staff.patient_profile', compact('patient', 'appointments'), ['page_title' => 'Patient Profile']);
    }

    public function submitPatientForm(Request $request)
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

        $patient->isactive = $request->has('isactive') ? 1 : 0;
        $patient->name = $name;
        $patient->email = $email;
        $patient->personal_number = $personal_number;
        $patient->phone = $phone;
        $patient->date_of_birth = $date_of_birth;
        $patient->address = $address;
        $patient->city = $city;
        $patient->state = $state;

        if ($patient->save()) {
            toast('Patient successfull created/updated1', 'success');
        } else {
            toast('Patient failed create/update', 'error');
        }
    }
}
