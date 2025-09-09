<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendenceController;
use App\Http\Controllers\LeaveRequestController;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::post('/loginsubmit', [AuthController::class, 'loginSubmit'])->name('login.submit');

Route::get('/employee/home', [AuthController::class, 'home'])->name('employee.home');

Route::get('/employee/edit_profile', [AuthController::class, 'edit_profile'])->name('employee.edit_profile');
Route::put('/employee/edit_profile', [AuthController::class, 'update_profile'])->name('employee.update_profile');

Route::get('employee/leave_request', [AuthController::class, 'leave_request'])->name('employee.leave_request');

Route::post('/leave-request', [LeaveRequestController::class, 'store'])->name('leave.request.submit');

Route::get('/employee/leave_request_history', [LeaveRequestController::class, 'history'])->name('employee.leave_request_history');

Route::get('/admin/admin',[DashboardController::class, 'admin'])->name('admin.admin');

Route::get('/admin/create', [EmployeeController::class, 'create'])->name('admin.create');

Route::get('/admin/employee_list', [EmployeeController::class, 'employeeList'])->name('admin.employee_list');

Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');

// Attendance Routes
Route::prefix('admin/attendance')->group(function () {
    Route::get('/', [AttendenceController::class, 'index'])->name('attendance.index');
    Route::post('/store', [AttendenceController::class, 'store'])->name('attendance.store');
});

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Admin view leave requests
Route::get('/admin/leave-requests', [LeaveRequestController::class, 'adminIndex'])->name('admin.leave_requests');

// Admin approve/reject request
Route::post('/admin/leave-requests/{id}/status', [LeaveRequestController::class, 'updateStatus'])->name('admin.leave_requests.status');
