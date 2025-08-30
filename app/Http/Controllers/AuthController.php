<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $user = User::where('username',$request->email)->first();
        if($user && $user->password_hash){
            if($request->password === $user->password_hash){
                session(['user' => $user]);
                return redirect()->route('employee.home'); 
            } 
            else {
                return back()->withErrors(['password' => 'Password mismatch']);
            }
        } else {
            return back()->withErrors(['email' => 'No user found with this email or invalid password']);
        }
        // $employee = Employee::where('email',$request->email)->first();
        // if($employee){
        //     if($request->password === $employee->password){
        //         session(['employee' => $employee]);
        //         return redirect()->route('employee.home');
        //     } 
        //     else {
        //         return back()->withErrors(['password' => 'Incorrect password']);
        //     }
        // }
    }
}
