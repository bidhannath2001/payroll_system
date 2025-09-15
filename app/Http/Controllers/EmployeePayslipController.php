<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\Attendence;
use App\Models\Salary;
use Carbon\Carbon;
use App\Models\BonusDeduction;
use Illuminate\Http\Request;
// use Barryvdh\DomPDF\Facade\Pdf;

class EmployeePayslipController extends Controller
{
    public function index()
    {
        $user = session('user');
        $employeeId = $user['employee_id'];
        
        $payrolls = Payroll::where('employee_id', $employeeId)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
            
        // Add month names to each payroll record
        $payrolls->getCollection()->transform(function ($payroll) {
            $payroll->month_name = Carbon::create(null, (int)$payroll->month, 1)->format('F');
            return $payroll;
        });
            
        return view('employee.payslip.index', compact('payrolls'));
    }

    public function show($id)
    {
        $user = session('user');
        $employeeId = $user['employee_id'];
        
        $payroll = Payroll::with('employee.department', 'employee.role')
            ->where('employee_id', $employeeId)
            ->findOrFail($id);
            
        $payroll->month_name = Carbon::create(null, (int)$payroll->month, 1)->format('F');
        
        // Get detailed salary information
        $salary = Salary::where('employee_id', $payroll->employee_id)->first();
        
        // Get attendance details for the month
        $attendance =Attendence::where('employee_id', $payroll->employee_id)
            ->whereMonth('date', $payroll->month)
            ->whereYear('date', $payroll->year)
            ->get();
            
        $presentDays = $attendance->where('status', 'Present')->count();
        $absentDays = $attendance->where('status', 'Absent')->count();
        $totalDays = $attendance->count();
        
        // If no attendance records, show default values
        if ($totalDays == 0) {
            $presentDays = 30; // Assume 30 days worked if no attendance records
            $absentDays = 0;
            $totalDays = 30;
        }
        
        // Get bonus/deduction details for the month
        $bonusDetails = BonusDeduction::where('employee_id', $payroll->employee_id)
            ->where('type', 'Bonus')
            ->whereMonth('date', $payroll->month)
            ->whereYear('date', $payroll->year)
            ->get();
            
        $deductionDetails = BonusDeduction::where('employee_id', $payroll->employee_id)
            ->where('type', 'Deduction')
            ->whereMonth('date', $payroll->month)
            ->whereYear('date', $payroll->year)
            ->get();
        
        return view('employee.payslip.show', compact('payroll', 'salary', 'presentDays', 'absentDays', 'totalDays', 'bonusDetails', 'deductionDetails'));
    }

    public function downloadPayslip($id)
    {
        $user = session('user');
        $employeeId = $user['employee_id'];
        
        $payroll = Payroll::with('employee.department', 'employee.role')
            ->where('employee_id', $employeeId)
            ->findOrFail($id);
            
        $payroll->month_name = Carbon::create(null, (int)$payroll->month, 1)->format('F');
        
        // Get detailed salary information
        $salary = Salary::where('employee_id', $payroll->employee_id)->first();
        
        // Get attendance details for the month
        $attendance = Attendence::where('employee_id', $payroll->employee_id)
            ->whereMonth('date', $payroll->month)
            ->whereYear('date', $payroll->year)
            ->get();
            
        $presentDays = $attendance->where('status', 'Present')->count();
        $absentDays = $attendance->where('status', 'Absent')->count();
        $totalDays = $attendance->count();
        
        // If no attendance records, show default values
        if ($totalDays == 0) {
            $presentDays = 30; // Assume 30 days worked if no attendance records
            $absentDays = 0;
            $totalDays = 30;
        }
        
        // Get bonus/deduction details for the month
        $bonusDetails = BonusDeduction::where('employee_id', $payroll->employee_id)
            ->where('type', 'Bonus')
            ->whereMonth('date', $payroll->month)
            ->whereYear('date', $payroll->year)
            ->get();
            
        $deductionDetails = BonusDeduction::where('employee_id', $payroll->employee_id)
            ->where('type', 'Deduction')
            ->whereMonth('date', $payroll->month)
            ->whereYear('date', $payroll->year)
            ->get();
        
        // For now, return the payslip view for printing
        return view('employee.payslip.payslip', compact('payroll', 'salary', 'presentDays', 'absentDays', 'totalDays', 'bonusDetails', 'deductionDetails'));
    }
}
