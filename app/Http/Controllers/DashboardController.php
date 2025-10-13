<?php

namespace App\Http\Controllers;

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
        


        // // Total salaries (all time)
        // $totalSalaries = Salary::sum('net_salary'); // assuming you have `net_salary` column

        // // This month salaries
        // $monthlySalaries = Salary::whereMonth('created_at', now()->month)
        //                         ->whereYear('created_at', now()->year)
        //                         ->sum('net_salary');

        // return view('dashboard', compact('totalSalaries', 'monthlySalaries'));
    }


    public function admin()
    {
        $totalUsers = 1500;
        $activeUsers = 1250;
        $pendingRequests = 50;
        $monthlyRevenue = '$50,000';
        $adminName = 'Jane Admin';

        return view('admin.admin', compact('totalUsers', 'activeUsers', 'pendingRequests', 'monthlyRevenue', 'adminName'));
    }


}