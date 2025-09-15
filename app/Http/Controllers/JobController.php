<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function jobDesk()
    {
        $jobs = Job::all();
        return view('jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'salary' => 'required|integer',
            'department' => 'required|string',
            'description' => 'required|string'
        ]);

        Job::create($validated);
        return redirect()->route('jobs.index')->with('success', 'Job position added!');
    }
}