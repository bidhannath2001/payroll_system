<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendenceController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\BonusDeductionController;
use App\Http\Controllers\EmployeePayslipController;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');



// 🧍‍♂️ Authentication Routes

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/loginsubmit', [AuthController::class, 'loginSubmit'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



// Employee Routes
Route::prefix('employee')->group(function () {

    Route::get('/home', [AuthController::class, 'home'])->name('employee.home');

    // Profile Management
    Route::get('/profile', [EmployeeController::class, 'showProfile'])->name('employee.profile');
    Route::get('/edit_profile', [AuthController::class, 'edit_profile'])->name('employee.edit_profile');
    Route::put('/edit_profile', [AuthController::class, 'update_profile'])->name('employee.update_profile');

    // Leave Requests
    Route::get('/leave_request', [AuthController::class, 'leave_request'])->name('employee.leave_request');
    Route::post('/leave-request', [LeaveRequestController::class, 'store'])->name('leave.request.submit');
    Route::get('/leave_request_history', [LeaveRequestController::class, 'history'])->name('employee.leave_request_history');

    // Payslip
    Route::prefix('payslip')->group(function () {
        Route::get('/', [EmployeePayslipController::class, 'index'])->name('employee.payslip.index');
        Route::get('/{id}', [EmployeePayslipController::class, 'show'])->name('employee.payslip.show');
        Route::get('/{id}/download', [EmployeePayslipController::class, 'downloadPayslip'])->name('employee.payslip.download');
    });
});


// Admin Routes
Route::prefix('admin')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('admin.admin');

    // Employee Management
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/create', [EmployeeController::class, 'create'])->name('admin.create');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/employee_list', [EmployeeController::class, 'employeeList'])->name('admin.employee_list');

    // Attendance
    Route::prefix('attendance')->group(function () {
        Route::get('/', [AttendenceController::class, 'index'])->name('attendance.index');
        Route::post('/store', [AttendenceController::class, 'store'])->name('attendance.store');
    });

    // Leave Requests
    Route::get('/leave-requests', [LeaveRequestController::class, 'adminIndex'])->name('admin.leave_requests');
    Route::post('/leave-requests/{id}/status', [LeaveRequestController::class, 'updateStatus'])->name('admin.leave_requests.status');

    // Payroll Management
    Route::prefix('payroll')->group(function () {
        Route::get('/', [PayrollController::class, 'index'])->name('admin.payroll.index');
        Route::get('/create', [PayrollController::class, 'create'])->name('admin.payroll.create');
        Route::post('/store', [PayrollController::class, 'store'])->name('admin.payroll.store');
        Route::get('/{id}', [PayrollController::class, 'show'])->name('admin.payroll.show');
        Route::get('/{id}/download', [PayrollController::class, 'downloadPayslip'])->name('admin.payroll.download');
    });

    // Salary Management
    Route::prefix('salary')->group(function () {
        Route::get('/', [SalaryController::class, 'index'])->name('admin.salary.index');
        Route::get('/create', [SalaryController::class, 'create'])->name('admin.salary.create');
        Route::post('/store', [SalaryController::class, 'store'])->name('admin.salary.store');
        Route::get('/{id}/edit', [SalaryController::class, 'edit'])->name('admin.salary.edit');
        Route::put('/{id}', [SalaryController::class, 'update'])->name('admin.salary.update');
        Route::delete('/{id}', [SalaryController::class, 'destroy'])->name('admin.salary.destroy');
    });

    // Bonus / Deduction Management
    Route::prefix('bonus-deduction')->group(function () {
        Route::get('/', [BonusDeductionController::class, 'index'])->name('admin.bonus_deduction.index');
        Route::get('/create', [BonusDeductionController::class, 'create'])->name('admin.bonus_deduction.create');
        Route::post('/store', [BonusDeductionController::class, 'store'])->name('admin.bonus_deduction.store');
        Route::get('/{id}/edit', [BonusDeductionController::class, 'edit'])->name('admin.bonus_deduction.edit');
        Route::put('/{id}', [BonusDeductionController::class, 'update'])->name('admin.bonus_deduction.update');
        Route::delete('/{id}', [BonusDeductionController::class, 'destroy'])->name('admin.bonus_deduction.destroy');
    });

});

