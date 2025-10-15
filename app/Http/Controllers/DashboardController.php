<?php

namespace App\Http\Controllers;

use App\Http\Controllers\EmployeeController;
use App\Models\Attendence;
use App\Models\Employee;
use App\Models\Salary;
use App\Models\LeaveRequest;
use App\Models\BonusDeduction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userName = 'Kimi';
        $announcements = [
            (object)['title' => 'Scrum Master', 'start' => 'Dec 4, 2019', 'end' => 'Dec 7, 2019', 'description' => 'Corrected item alignment.'],
        ];

        return view('dashboard', compact('userName', 'announcements'));
    }


    public function admin()
    {
        $totalUsers = Employee::count();
        $today = Carbon::today();
        $activeUsers = Attendence::whereDate('date', $today)
            ->where('status', 'Present')
            ->count();

        $pendingRequests = 50;
        
        // Calculate total monthly cost: basic salaries + bonuses
        $totalBasicSalary = Salary::sum('basic_salary');
        $totalBonuses = BonusDeduction::where('type', 'bonus')->sum('amount');
        $monthlycost = $totalBasicSalary + $totalBonuses;
        
        $monthlyRevenue = '$50,000';
        // Resolve logged-in user and admin name from employees table
        $user = session('user');
        $employee = $user ? Employee::find($user->employee_id) : null;
        $adminName = $employee ? ($employee->first_name . ' ' . $employee->last_name) : 'Admin';
        
        // Get admin's profile picture from employee record
        if ($employee && $employee->id_proof) {
            $adminPhotoUrl = asset('storage/' . $employee->id_proof);
        } else {
            // Fallback to generated avatar if no profile picture
            $adminPhotoUrl = 'https://ui-avatars.com/api/?name=' . urlencode($adminName) . '&size=60&background=007bff&color=ffffff';
        }
        $workinghours= Attendence::sum('working_hours');
       
        $leaverequests = LeaveRequest::count();
        
        // Get recent activities for dashboard
        $recentAttendance = Attendence::with('employee')
            ->orderBy('date', 'desc')
            ->limit(5)
            ->get();
            
        $recentLeaveRequests = LeaveRequest::with('employee')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        $pendingLeaveRequests = LeaveRequest::where('status', 'Pending')
            ->with('employee')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
            
        // Get additional useful data for dashboard
        $totalDepartments = \App\Models\Department::count();
        $totalRoles = \App\Models\Role::count();
        $thisMonthPayrolls = \App\Models\Payroll::whereMonth('generated_at', now()->month)
            ->whereYear('generated_at', now()->year)
            ->count();
        $recentPayrolls = \App\Models\Payroll::with('employee')
            ->orderBy('generated_at', 'desc')
            ->limit(3)
            ->get();
            
        // Get employees by department for the chart
        $employeesByDepartment = \App\Models\Employee::with('department')
            ->selectRaw('department_id, COUNT(*) as employee_count')
            ->groupBy('department_id')
            ->get()
            ->map(function($item) {
                return [
                    'department_name' => $item->department->department_name ?? 'Unknown',
                    'employee_count' => $item->employee_count
                ];
            });
            
        // Get salary breakdown data for pie chart
        $totalBasicSalary = Salary::sum('basic_salary');
        $totalAllowances = Salary::sum('allowances');
        $totalBonuses = BonusDeduction::where('type', 'bonus')->sum('amount');
        $totalDeductions = BonusDeduction::where('type', 'deduction')->sum('amount');
        
        $salaryBreakdown = [
            ['label' => 'Basic Salary', 'value' => $totalBasicSalary, 'color' => '#28a745'],
            ['label' => 'Allowances', 'value' => $totalAllowances, 'color' => '#007bff'],
            ['label' => 'Bonuses', 'value' => $totalBonuses, 'color' => '#6f42c1'],
            ['label' => 'Deductions', 'value' => $totalDeductions, 'color' => '#dc3545']
        ];
        

        return view('admin.admin', compact('totalUsers', 'activeUsers', 'pendingRequests', 'monthlycost', 'adminName','monthlyRevenue','workinghours','leaverequests', 'adminPhotoUrl', 'recentAttendance', 'recentLeaveRequests', 'pendingLeaveRequests', 'totalDepartments', 'totalRoles', 'thisMonthPayrolls', 'recentPayrolls', 'employeesByDepartment', 'salaryBreakdown'));
    }
}