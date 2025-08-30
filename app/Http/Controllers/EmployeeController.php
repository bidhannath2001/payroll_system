<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function home()
    {
        return view('employee.home');
    }

    public function create()
    {
        $departments = Department::all();
        $roles = Role::all();
        return view('admin.create', compact('departments', 'roles'));
    }

    public function employeeList()
    {
        // Paginate data (10 per page)
        $employees = Employee::with(['department', 'role'])->paginate(10);
        return view('admin.employee_list', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'dob' => 'required|date',
            'gender' => 'required|string',
            'designation' => 'required|string|max:100',
            'department_id' => 'required|exists:departments,department_id',
            'role_id' => 'required|exists:roles,role_id',
            'date_joined' => 'required|date',
            'status' => 'required|string|in:full time,part time',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:150|unique:employees,email',
            'address' => 'required|string',
            'resume' => 'nullable|mimes:pdf,doc,docx|max:2048',
            'id_proof' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // handle file uploads
        if ($request->hasFile('resume')) {
            $validated['resume'] = $request->file('resume')->store('resumes', 'public');
        }
        if ($request->hasFile('id_proof')) {
            $validated['id_proof'] = $request->file('id_proof')->store('id_proofs', 'public');
        }

        // Create employee
        $employee = Employee::create($validated);

        return redirect()->route('admin.admin')->with('success', 'Employee account created successfully.');
    }
}
