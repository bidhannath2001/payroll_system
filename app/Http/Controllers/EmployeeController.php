<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
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

    public function store(EmployeeRequest $request)
    {
        $validated = $request->getValidatedWithFiles();

        //debug
        // dd($validated);
        // Create employee
        $employee = Employee::create($validated);

        return redirect()->route('admin.admin')->with('success', 'Employee account created successfully.');
    }
}
