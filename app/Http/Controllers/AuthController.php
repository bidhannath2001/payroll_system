<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        $user = session('user');
    }

    public function login()
    {
        // If already logged in, send them home
        if (session()->has('user')) {
            return redirect()->route('employee.home');
        }

        return view('auth.login');
    }

    public function loginSubmit(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->email)->first();

        if ($user && $user->password_hash) {
            if ($request->password === $user->password_hash) {
                session(['user' => $user]);
                return redirect()->route('employee.home');
            } else {
                return back()->withErrors(['password' => 'Password mismatch']);
            }
        } else {
            return back()->withErrors(['email' => 'No user found with this email or invalid password']);
        }
    }

    public function home()
    {
        $user = session('user');

        if (!$user) {
            return redirect()->route('login');
        }
        $employee = Employee::find($user->employee_id);

        return view('employee.home', compact('user', 'employee'));
    }


    public function edit_profile()
    {
        $user = session('user');

        if (!$user) {
            return redirect()->route('login');
        }

        $employee = Employee::find($user->employee_id);

        return view('employee.edit_profile', compact('employee', 'user'));
    }

    public function logout(Request $request)
    {
        // clear session
        $request->session()->forget('user');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
    public function update_profile(Request $request)
    {
        $user = session('user');
        $employee = Employee::find($user->employee_id);
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'dob' => 'required|date',
            'gender' => 'required|string',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:150|unique:users,username,' . $user->user_id . ',user_id',
            'address' => 'required|string',
            'password_hash' => 'nullable|string|min:6',
            'id_proof' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
        $employee->first_name = $request->first_name;
        $employee->last_name  = $request->last_name;
        $employee->dob        = $request->dob;
        $employee->gender     = $request->gender;
        $employee->phone      = $request->phone;
        $employee->email      = $request->email;
        $employee->address    = $request->address;
        $user->username       = $request->email;

        if ($request->filled('email')) {
            $user->username = $request->email;
        }
        if ($request->filled('password_hash')) {
            $user->password_hash = $request->password_hash;
        }
        if ($request->hasFile('id_proof')) {
            $idProofPath = $request->file('id_proof')->store('id_proofs', 'public');
            $employee->id_proof = $idProofPath;
        }
        $employee->save();
        $user->save();
        if ($request->filled('password_hash')) {
            return redirect()->route('employee.edit_profile')
                ->with('success', 'Profile updated successfully with new password.');
        } 
        else {
            return redirect()->route('employee.edit_profile')
                ->with('success', 'Profile updated successfully. Your previous password is kept.');
        }
    }
    public function leave_request(){
        return view('employee.leave_request');
    }
}
