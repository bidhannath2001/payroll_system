<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function home()
    {
        $employee = session('employee');

        if (!$employee) {
            return redirect('/login');
        }

        $attendance = $employee['attendance'] ?? [];
        $payslips = $employee['payslips'] ?? [];

        return view('employee.home', compact('employee', 'attendance', 'payslips'));
    }
}
