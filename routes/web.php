<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

Route::get('/', function () {
    return view('auth/login');
});

//simulate login (set session)
Route::get('/login', function () {
    session(['employee' => [
        'name' => 'John Doe',
        'email' => 'john@example.com',
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
});

Route::get('/employee/home', [EmployeeController::class, 'home'])->name('employee.home');

// Route::get('/employee/profile/edit', [EmployeeController::class, 'edit'])->name('employee.profile.edit');

// Route::post('/employee/profile/update', [EmployeeController::class, 'update'])->name('employee.profile.update');

// Route::post('/employee/profile/update', [EmployeeController::class, 'update'])->name('employee.profile.update');

Route::post('/logout', function () {
    session()->forget('employee');  // clear employee session
    return redirect('/');       // redirect to login or welcome page
})->name('logout');
