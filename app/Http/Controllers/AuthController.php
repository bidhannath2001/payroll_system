<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }
    public function loginSubmit(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $employee = Employee::where('email',$request->email)->first();
        if($employee){
            if($request->password === $employee->password){
                session(['employee' => $employee]);
                return redirect()->route('employee.home');
            } 
            else {
                return back()->withErrors(['password' => 'Incorrect password']);
            }
        }
    }
}
