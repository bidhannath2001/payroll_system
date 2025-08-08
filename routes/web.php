<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use Illuminate\Http\Request;

// Show login page
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Handle login form
Route::post('/login', function (Request $request) {
    $email = $request->input('email');
    $password = $request->input('password');

    // Dummy authentication
    if ($email === 'john@example.com' && $password === '123') {
        session(['employee' => [
            'name' => 'John Doe',
            'email' => $email,
            'department' => 'IT',
            'attendance' => [
                'present_days' => 20,
                'absent_days' => 2,
                'last_check_in' => '2025-08-01 09:00 AM'
            ],
            'payslips' => [
                ['id' => 1, 'month' => 'July', 'year' => 2025],
                ['id' => 2, 'month' => 'June', 'year' => 2025]
            ]
        ]]);

        return redirect()->route('employee.home');
    } 
    else {
        return redirect()->route('login')->with('error', 'Invalid email or password');
    }
})->name('login.submit');


Route::get('/employee/home', [EmployeeController::class, 'home'])->name('employee.home');


Route::post('/logout', function () {
    session()->forget('employee');  // clear employee session
    return view('auth.login');       // redirect to login or welcome page
})->name('logout');

Route::get('/admin/admin',[DashboardController::class, 'admin'])->name('admin.admin');

Route::get('/admin/create', [EmployeeController::class, 'create'])->name('admin.create');

Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');