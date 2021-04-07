<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function staffLogin()
    {
        return view('staff.login');
    }

    public function index(Request $request)
    {
        $who = $request->segment(1);
        if ($who === 'slogin') {
            return view('staff.login');
        } else {
            return view('patient.login');
        }
    }


    public function check(Request $request)
    {
        $staff_patient = $request->input('staff_patient');
        $email = $request->input('email');
        $password = $request->input('password');
        $role = '';
        if ($staff_patient == 'staff') {

            if (Auth::guard('staff')->attempt([
                'email' => $email,
                'password' => $password
            ])) {
                $id = Auth::guard('staff')->id();
                $staff = Staff::find($id);
                $role = $staff->role;

                session(['Staff_Auth' => true]);
                session(['id' => $id]);
                session(['role' => $role]);
                return redirect(route('staff.dashboard'));
            } else {
                toast('Email or password is incorrect','error');
                return redirect()->route('staff.login');
            }

        } else {
            if (Auth::guard('patient')->attempt([
                'email' => $email,
                'password' => $password,
                'isactive' => 1,
            ])) {
                $id = Auth::guard('patient')->id();

                session(['Patient_Auth' => true]);
                session(['id' => $id]);
                //return view('patient.dashboard');
                return redirect()->route('patient.dashboard');
            } else {
                toast('Email or password is incorrect','error');
                return redirect()->route('patient.login');

            }
        }
    }

    public function staffRegister()
    {
        return view('staff.register');
    }

    public function register(Request $request)
    {
        $role = 'admin';
        $name = $request->input('name');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));
        $address = 'address';
        $phone = '123456789';
        $staff = new Staff();

        $staff->role = $role;
        $staff->name = $name;
        $staff->email = $email;
        $staff->password = $password;
        $staff->address = $address;
        $staff->phone = $phone;

        $staff->save();
    }

//    public function logout(Request $request)
//    {
//
//        Auth::logout();
//
//        $request->session()->flush();
//
//        $request->session()->regenerate();
//
//        return redirect(route( 'home' ));
//    }

}
