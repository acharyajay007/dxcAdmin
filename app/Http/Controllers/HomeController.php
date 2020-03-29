<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = auth()->user();
        if ($employee->hasRole('employee')) {
            return view('profile', ['employee'=> $employee, 'canGoBack'=>0]);
        } else {
            $employees = User::role('employee')->count();
            return view('home',['totalEmployees'=>$employees]); 
        }
        
        
    }

    /**
     * Show the profile
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $employee = auth()->user();
        return view('profile', ['employee'=> $employee, 'canGoBack'=>1]);
    }
}
