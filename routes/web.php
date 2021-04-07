<?php

use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', function () {
    if (Auth::guard('staff')->check()) {
        return redirect()->route('staff.dashboard');
    } elseif (Auth::guard('patient')->check()) {
        return redirect()->route('patient.dashboard');
    } else {
        return redirect(route('home'));
    }
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('slogin', [App\Http\Controllers\LoginController::class, 'index'])->name('staff.login');
Route::get('plogin', [App\Http\Controllers\LoginController::class, 'index'])->name('patient.login');
Route::get('logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
Route::post('check', [App\Http\Controllers\LoginController::class, 'check'])->name('check');

Route::get('/home', [App\Http\Controllers\PatientController::class, 'home'])->name('home');
Route::get('doctor_profile/{id}', [App\Http\Controllers\PatientController::class, 'doctorProfile'])->name('patient.doctor_profile');
Route::get('doctors', [App\Http\Controllers\PatientController::class, 'doctors'])->name('patient.doctors');
Route::get('patinet_form', [App\Http\Controllers\PatientController::class, 'patient_form'])->name('patient_fomr');
Route::post('submit_patinet_form', [App\Http\Controllers\PatientController::class, 'submit_patient_form'])->name('submit_patient_forms');


Route::prefix('admin')->middleware('is_admin')->group(function () {
    Route::get('doctors', [App\Http\Controllers\AdminController::class, 'staffDoctors'])->name('admin.doctors');
    Route::get('receptionists', [App\Http\Controllers\AdminController::class, 'staffReceptionists'])->name('admin.receptionists');
});


Route::prefix('staff')->middleware('auth_staff')->group(function(){
    Route::get('dashboard', [App\Http\Controllers\StaffController::class, 'index'])->name('staff.dashboard');
    Route::get('appointments', [App\Http\Controllers\StaffController::class, 'appointments'])->name('staff.appointments');
    Route::get('profile/{id?}', [App\Http\Controllers\StaffController::class, 'profile'])->name('staff.profile');
    Route::get('staff_form/{id?}', [App\Http\Controllers\StaffController::class, 'staffForm'])->name('staff_form');
    Route::post('submit_staff_form', [App\Http\Controllers\StaffController::class, 'submitStaffForm'])->name('submit_staff_form');
    Route::get('patients', [App\Http\Controllers\StaffController::class, 'patients'])->name('staff.patients');
    Route::get('patient_profile/{id?}', [App\Http\Controllers\StaffController::class, 'patientProfile'])->name('staff.patient_profile');
    Route::get('patient_form/{id?}', [App\Http\Controllers\StaffController::class, 'patientForm'])->name('staff.patient_form');
    Route::post('submit_patient_form', [App\Http\Controllers\StaffController::class, 'submitPatientForm'])->name('staff.submit_patient_form');
    Route::post('edit_appointment_status', [App\Http\Controllers\StaffController::class, 'submitEditAppointmentStatus'])->name('staff.submit_edit_appointment_status');
    Route::post('change_password', [App\Http\Controllers\StaffController::class, 'change_password'])->name('staff.change_password');
    Route::get('search_appointments', [App\Http\Controllers\StaffController::class, 'search_appointments'])->name('staff.search_appointments');
});

Route::prefix('patient')->middleware('auth_patient')->group(function(){
    Route::get('dashboard', [App\Http\Controllers\PatientController::class, 'index'])->name('patient.dashboard');
    Route::get('profile', [App\Http\Controllers\PatientController::class, 'patientProfile'])->name('patient.profile');
    Route::post('change_password', [App\Http\Controllers\PatientController::class, 'change_password'])->name('patient.change_password');
    Route::get('booking/{id}', [App\Http\Controllers\PatientController::class, 'booking'])->name('patient.booking');
    Route::post('save_appointment', [App\Http\Controllers\PatientController::class, 'saveAppointment'])->name('patient.save_appointment');
});



