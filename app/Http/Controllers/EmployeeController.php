<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\String_;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $employees = Employee::with('department')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('designation', 'like', "%{$search}%")
                        ->orWhereHas('department', function ($d) use ($search) {
                            $d->where('department_name', 'like', "%{$search}%");
                        });
                });
            })
            ->paginate(10);

        return view('admin.employee_list', compact('employees'));
        // $employees = Employee::all();
        $departments = Department::all();
        $roles = Role::all();
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
        Employee::create($validated);

        return redirect()->route('admin.admin')->with('success', 'Employee account created successfully.');
    }

    public function showProfile()
    {
        $userId = Auth::id(); // assuming user_id = employee_id
        $employee = Employee::where('employee_id', $userId)->first();

        if ($employee) {
            $attendances = $employee->attendances()->get();
            $presentDays = $attendances->where('status', 'Present')->count();
            $absentDays  = $attendances->where('status', 'Absent')->count();
            $lastCheckIn = $attendances->sortByDesc('date')->first()?->check_in;
        } else {
            $presentDays = $absentDays = 0;
            $lastCheckIn = null;
        }

        return view('employee.profile', compact(
            'employee',
            'presentDays',
            'absentDays',
            'lastCheckIn'
        ));
    }
}
