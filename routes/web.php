<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::post('/loginsubmit', [AuthController::class, 'loginSubmit'])->name('login.submit');

Route::get('/employee/home', [AuthController::class, 'home'])->name('employee.home');

Route::get('/employee/edit_profile', [AuthController::class, 'edit_profile'])->name('employee.edit_profile');
Route::put('/employee/edit_profile', [AuthController::class, 'update_profile'])->name('employee.update_profile');

Route::get('/admin/admin',[DashboardController::class, 'admin'])->name('admin.admin');

Route::get('/admin/create', [EmployeeController::class, 'create'])->name('admin.create');

Route::get('/admin/employee_list', [EmployeeController::class, 'employeeList'])->name('admin.employee_list');

Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');

Route::get('/', function () {
    return view('welcome');
})->name('welcome');