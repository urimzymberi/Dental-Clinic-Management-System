<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('staff.admin.dashboard');
    }

//    public function appointments()
//    {
//        $appointmetns = Appointment::orderBy('id', 'desc')->get();
//        return view('staff.admin.appointments');
//    }

    public function staffDoctors()
    {
        $staff_ = Staff::where('role', 'doctor')->orderBy('id', 'desc')->paginate(12);
        return view('staff.admin.staff', compact('staff_'), ['page_title' => 'Doctors']);
    }

    public function staffReceptionists()
    {
        $staff_ = Staff::where('role', 'receptionist')->orderBy('id', 'desc')->paginate(12);
        return view('staff.admin.staff', compact('staff_'), ['page_title' => 'Receptionists']);
    }



//    public function staffForm($id = null)
//    {
//        if ($id != null) {
//            $staff = Staff::findOrFail($id);
//        } else {
//            $staff = (object)[
//                'id' => 0,
//                'role' => '',
//                'isactive' => 0,
//                'name' => '',
//                'email' => '',
//                'personal_number' => '',
//                'phone' => '',
//                'date_of_birth' => '',
//                'image' => '',
//                'biography' => '',
//                'address' => '',
//                'city' => '',
//                'state' => 'Kosove',
//                'education' => '',
//                'experience' => '',
//                'service' => '',
//                'specialization' => '',
//            ];
//        }
//        return view('staff.admin.staff_form', compact('staff'));
//    }

//    public function submitStaffForm(Request $request)
//    {
//        $validatedData = $request->validate([
//            'role' => 'required|numeric|max:3|min:1',
//            'name' => 'required|max:50|string',
//            'email' => 'required|max:100|string|unique:staff,email',
//            'personal_number' => 'required|numeric|digits:10',
//            'phone' => 'required|max:20',
//            'date_of_birth' => 'required|date_format:Y/m/d',/*date_format:d/m/Y*/
//            'image' => 'required|image',
//            'biography' => '',
//            'address' => 'required|max:255',
//            'city' => 'required|max:20',
//            'state' => 'required|max:20',
//            'degree' => '',
//            'college' => '',
//            'year_of_completion' => '',
//            'service' => '',
//            'specialization' => '',
//        ]);
//
//        $role = filter_var($request->input('role'), FILTER_SANITIZE_NUMBER_INT);
//        $name = $request->input('name');
//        $email = $request->input('email');
//        $personal_number = filter_var($request->input('personal_number'), FILTER_SANITIZE_NUMBER_INT);
//        $phone = filter_var($request->input('phone'), FILTER_SANITIZE_STRING);
//        $date_of_birth = filter_var($request->input('date_of_birth'), FILTER_SANITIZE_STRING);
//        $biography = filter_var($request->input('biography'), FILTER_SANITIZE_STRING);
//        $address = filter_var($request->input('address'), FILTER_SANITIZE_STRING);
//        $city = filter_var($request->input('city'), FILTER_SANITIZE_STRING);
//        $state = filter_var($request->input('state'), FILTER_SANITIZE_STRING);
//        $degree = filter_var($request->input('degree'), FILTER_SANITIZE_STRING);
//        $college = filter_var($request->input('college'), FILTER_SANITIZE_STRING);
//        $year_of_completion = filter_var($request->input('year_of_completion'), FILTER_SANITIZE_STRING);
//        $service = filter_var($request->input('service'), FILTER_SANITIZE_STRING);
//        $specialization = filter_var($request->input('specialization'), FILTER_SANITIZE_STRING);
//
//        $id = $request->input('id');
//        if ($id != 0) {
//            $staff = Staff::findOrFail($id);
//        } else {
//            $password = Hash::make(filter_var($request->input('personal_number'), FILTER_SANITIZE_NUMBER_INT));
//            $staff = new Staff();
//            $staff->password = $password;
//        }
//
//        switch ($role) {
//            case 1:
//                $role = 'admin';
//                break;
//
//            case 2:
//                $role = 'doctor';
//                break;
//
//            case 3:
//                $role = 'receptionist';
//                break;
//        }
//
//        $path = 'user_images/no-photo.jpg';
//        if ($request->file('image') != null) {
//            $path = $request->file('image')->store('user_images');
//        }
//
//        $education['degree'] = $degree;
//        $education['college'] = $college;
//        $education['year_of_completion'] = $year_of_completion;
//        $json_education = json_encode($education);
//
//        $experience = null;
//
//        $service_['service'] = $service;
//        $json_service = json_encode($service_);
//
//
//        $specialization_['specialization'] = $specialization;
//        $json_specialization = json_encode($specialization_);
//
//
//        $staff->role = $role;
//        $staff->isactive = $request->has('isactive') ? 1 : 0;
//        $staff->name = $name;
//        $staff->email = $email;
//        $staff->personal_number = $personal_number;
//        $staff->phone = $phone;
//        $staff->date_of_birth = $date_of_birth;
//        $staff->image = $path;
//        $staff->biography = $biography;
//        $staff->address = $address;
//        $staff->city = $city;
//        $staff->education = $state;
//        $staff->education = $json_education;
//        $staff->experience = $experience;
//        $staff->service = $json_service;
//        $staff->specialization = $json_specialization;
//
//
//        if ($staff->save()) {
//            echo 'u rujt me sukses';
//        } else {
//            echo 'deshtoi ruajtja';
//        }
//
//    }

//    public function staffProfile($id = null)
//    {
//        $staff = Staff::findOrFail($id);
//
//        return view('staff.admin.profile', compact('staff'));
//    }

//    public function patients()
//    {
//        $patients = Patient::orderBy('id', 'desc')->paginate(12);
//        return view('staff.admin.patients', compact('patients'));
//    }

//    public function patientForm($id = null)
//    {
//        if ($id != null) {
//            $patient = Patient::findOrFail($id);
//        } else {
//            $patient = (object)[
//                'id' => 0,
//                'isactive'=>1,
//                'name' => '',
//                'date_of_birth' => '',
//                'email' => '',
//                'personal_number' => '',
//                'phone' => '',
//                'address' => '',
//                'city' => '',
//                'state' => 'Kosove',
//            ];
//        }
//        return view('staff.admin.patient_form', compact('patient'));
//    }

//    public function patientProfile($id = null)
//    {
//
//        $patient = Patient::findOrFail($id);
//        $appointments = Appointment::where('patient_id', $patient->id)->with('staff')->get();
//
//        return view('staff.admin.patient_profile', compact('patient', 'appointments'));
//    }

//    public function submitPatientForm(Request $request)
//    {
//        $validatedData = $request->validate([
//            'name' => 'required|max:50|string',
//            'email' => 'required|max:100|string|unique:staff,email',
//            'personal_number' => 'required|numeric|digits:10',
//            'phone' => 'required|max:20',
//            'date_of_birth' => 'required|date_format:Y-m-d',/*date_format:d/m/Y*/
//            'address' => 'required|max:255',
//            'city' => 'required|max:20',
//            'state' => 'required|max:20',
//        ]);
//
//        $name = $request->input('name');
//        $email = $request->input('email');
//        $personal_number = filter_var($request->input('personal_number'), FILTER_SANITIZE_NUMBER_INT);
//        $phone = filter_var($request->input('phone'), FILTER_SANITIZE_STRING);
//        $date_of_birth = filter_var($request->input('date_of_birth'), FILTER_SANITIZE_STRING);
//        $address = filter_var($request->input('address'), FILTER_SANITIZE_STRING);
//        $city = filter_var($request->input('city'), FILTER_SANITIZE_STRING);
//        $state = filter_var($request->input('state'), FILTER_SANITIZE_STRING);
//
//        $id = $request->input('id');
//        if ($id != 0) {
//            $patient = Patient::findOrFail($id);
//        } else {
//            $password = Hash::make(filter_var($request->input('personal_number'), FILTER_SANITIZE_NUMBER_INT));
//            $patient = new Patient();
//            $patient->password = $password;
//        }
//
//
//        $patient->isactive = $request->has('isactive') ? 1 : 0;
//        $patient->name = $name;
//        $patient->email = $email;
//        $patient->personal_number = $personal_number;
//        $patient->phone = $phone;
//        $patient->date_of_birth = $date_of_birth;
//        $patient->address = $address;
//        $patient->city = $city;
//        $patient->state = $state;
//
//        if ($patient->save()) {
//            echo 'u rujt me sukses';
//        } else {
//            echo 'deshtoi ruajtja';
//        }
//
//    }
}
