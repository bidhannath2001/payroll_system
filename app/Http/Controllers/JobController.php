<?php
namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Department;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Restrict to authenticated users
    }

    public function index()
    {
        $jobs = Job::all();
        return view('jobs.index', compact('jobs'));
    }

    public function create()
    {
        $departments = Department::all(); // Fetch departments
        $roles = Role::all();            // Fetch roles
        return view('jobs.create', compact('departments', 'roles'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'dob' => 'required|date',
                'gender' => 'required',
                'designation' => 'required',
                'department_id' => 'required|exists:departments,department_id',
                'role_id' => 'required|exists:roles,role_id',
                'joining_date' => 'required|date',
                'employment_type' => 'required',
                'salary_range' => 'required',
                'phone' => 'required',
                'email' => 'required|email',
                'address' => 'required',
                'emergency_contact_name' => 'required',
                'emergency_contact_phone' => 'required',
                'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
                'id_proof' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);

            $data = $validated;

            // Handle file uploads
            if ($request->hasFile('resume')) {
                $data['resume'] = $request->file('resume')->store('uploads/resumes', 'public');
            }
            if ($request->hasFile('id_proof')) {
                $data['id_proof'] = $request->file('id_proof')->store('uploads/id_proofs', 'public');
            }

            Job::create($data);
            return redirect()->route('jobs.index')->with('success', 'Job position added!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
        }
    }
}