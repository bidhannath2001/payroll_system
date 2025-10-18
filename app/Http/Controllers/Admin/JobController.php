<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;

class JobController extends Controller
{
    public function create()
    {
        return view('admin.job.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'job_title' => 'required|string|max:255',
            'Description' => 'required|string',
            'salary_range' => 'required|string|max:255',
            'joining_date' => 'required|date',
        ]);

        Job::create([
            'job_title' => $request->job_title,
            'description' => $request->Description,
            'salary_range' => $request->salary_range,
            'joining_date' => $request->joining_date,
        ]);

        return redirect()->back()->with('success', 'Job created successfully!');
    }

    public function index()
    {
        $jobs = Job::all();
        return view('admin.job.index', compact('jobs'));
    }
}
