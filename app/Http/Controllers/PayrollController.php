<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payroll;
use App\Models\Employee;
use App\Models\Salary;
use App\Models\BonusDeduction;
use App\Models\Attendence;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class PayrollController extends Controller
{
    public function index()
    {
        $payrolls = Payroll::with('employee')
            ->orderBy('generated_at', 'desc')
            ->paginate(20);
            
        // Add month names to each payroll record
        $payrolls->getCollection()->transform(function ($payroll) {
            $payroll->month_name = Carbon::create(null, (int)$payroll->month, 1)->format('F');
            return $payroll;
        });
            
        return view('admin.payroll.index', compact('payrolls'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('admin.payroll.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,employee_id',
            'month' => 'required|integer|between:1,12',
            'year' => 'required|integer|min:2020|max:2030',
        ]);

        $employee = Employee::findOrFail($request->employee_id);
        $salary = Salary::where('employee_id', $employee->employee_id)->first();
        
        if (!$salary) {
            return redirect()->back()->with('error', 'No salary record found for this employee.');
        }

        // Calculate attendance for the month
        $attendance = Attendence::where('employee_id', $employee->employee_id)
            ->whereMonth('date', $request->month)
            ->whereYear('date', $request->year)
            ->get();

        $totalDays = $attendance->count();
        $presentDays = $attendance->where('status', 'Present')->count();
        $absentDays = $attendance->where('status', 'Absent')->count();

        // Calculate gross salary (NOT based on attendance - full salary)
        // If no attendance records, assume full month worked (30 days)
        if ($totalDays == 0) {
            $presentDays = 30; // Assume 30 days worked if no attendance records
            $absentDays = 0;
            $totalDays = 30;
        }
        
        // Gross salary is full basic salary + allowances (not prorated by attendance)
        $grossSalary = $salary->basic_salary + $salary->allowances;
         
        // Get bonuses for the month (type = 'Bonus')
        $bonuses = BonusDeduction::where('employee_id', $employee->employee_id)
            ->where('type', 'Bonus')
            ->whereMonth('date', $request->month)
            ->whereYear('date', $request->year)
            ->sum('amount');

        // Get deductions for the month (type = 'Deduction')
        $bonusDeductions = BonusDeduction::where('employee_id', $employee->employee_id)
            ->where('type', 'Deduction')
            ->whereMonth('date', $request->month)
            ->whereYear('date', $request->year)
            ->sum('amount');


        // Calculate tax deduction based on gross salary
        $taxDeduction = ($grossSalary * $salary->tax_percentage) / 100;

        // Total deductions = salary deductions + bonus deductions + tax
        $totalDeductions = $salary->deductions + $bonusDeductions + $taxDeduction;

        // Net salary = gross salary + bonuses - total deductions
        $netSalary = $grossSalary + $bonuses - $totalDeductions;

        $payroll = Payroll::create([
            'employee_id' => $request->employee_id,
            'month' => $request->month,
            'year' => $request->year,
            'gross_salary' => $grossSalary,
            'total_deductions' => $totalDeductions,
            'bonuses' => $bonuses,
            'net_salary' => $netSalary,
            'generated_at' => now(),
        ]);

        return redirect()->route('admin.payroll.index')
            ->with('success', 'Payroll generated successfully.');
    }

    public function show($id)
    {
        $payroll = Payroll::with('employee')->findOrFail($id);
        $payroll->month_name = \Carbon\Carbon::create(null, (int)$payroll->month, 1)->format('F');
        
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
        
        return view('admin.payroll.show', compact('payroll', 'salary', 'presentDays', 'absentDays', 'totalDays', 'bonusDetails', 'deductionDetails'));
    }

    public function downloadPayslip($id)
    {
        $payroll = Payroll::with('employee')->findOrFail($id);
        $payroll->month_name = \Carbon\Carbon::create(null, (int)$payroll->month, 1)->format('F');
        
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
        
        $pdf = Pdf::loadView('admin.payroll.payslip', compact('payroll', 'salary', 'presentDays', 'absentDays', 'totalDays', 'bonusDetails', 'deductionDetails'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('payslip-' . $payroll->employee->first_name . '-' . $payroll->month_name . '-' . $payroll->year . '.pdf');
    }
}
