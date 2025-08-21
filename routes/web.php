<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use Illuminate\Http\Request;

Route::post('/logout', function () {
    session()->forget('employee');  // clear employee session
    return view('auth.login');       // redirect to login or welcome page
})->name('logout');

// Show login page
// Route::get('/login', function () {
//     return view('auth.login');
// })->name('login');

Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::post('/loginsubmit', [AuthController::class, 'loginSubmit'])->name('login.submit');

Route::get('/employee/home', [EmployeeController::class, 'home'])->name('employee.home');

Route::get('/admin/admin',[DashboardController::class, 'admin'])->name('admin.admin');

Route::get('/admin/create', [EmployeeController::class, 'create'])->name('admin.create');

Route::get('/admin/employee_list', [EmployeeController::class, 'employeeList'])->name('admin.employee_list');

Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');