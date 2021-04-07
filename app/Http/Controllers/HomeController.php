<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
            $doctors = Staff::where([
                ['role', '=', 'doctor'],
                ['isactive', '=', 1]
            ])->inRandomOrder()->take(3)->get();
            return view('home')->with(compact('doctors'));
    }
}
