<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the regular user dashboard.
     */
    public function index()
    {
        // Example dynamic data for the regular dashboard
        $userName = 'Kimi';
        $announcements = [
            (object)['title' => 'Scrum Master', 'start' => 'Dec 4, 2019', 'end' => 'Dec 7, 2019', 'description' => 'Corrected item alignment.'],
            // ...
        ];

        return view('dashboard', compact('userName', 'announcements'));
    }

    /**
     * Display the admin dashboard.
     * This method corresponds to the /dashboard/admin route.
     */
    public function admin()
    {
        // Here you would fetch data specific to the admin dashboard.
        // For example:
        $totalUsers = 1500;
        $activeUsers = 1250;
        $pendingRequests = 50;
        $monthlyRevenue = '$50,000';
        $adminName = 'Jane Admin';

        // Pass the data to the view using an associative array or compact()
        return view('admin.admin', compact('totalUsers', 'activeUsers', 'pendingRequests', 'monthlyRevenue', 'adminName'));
    }
}
