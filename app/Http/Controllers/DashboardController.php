<?php

namespace App\Http\Controllers;

use App\Http\Controllers\EmployeeController;
use App\Models\Attendence;
use App\Models\Employee;
use App\Models\Salary;
use App\Models\LeaveRequest;
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
            ->where('status', 'present')
            ->count();

        $pendingRequests = 50;
        $monthlycost = Salary::sum('basic_salary');
        $monthlyRevenue = '$50,000';
        $adminName = '';
        $workinghours= Attendence::sum('working_hours');
        // Total number of leave requests across all statuses
        $leaverequests = LeaveRequest::count();

        return view('admin.admin', compact('totalUsers', 'activeUsers', 'pendingRequests', 'monthlycost', 'adminName','monthlyRevenue','workinghours','leaverequests'));
    }
}
