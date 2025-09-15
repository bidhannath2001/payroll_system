<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function index()
    {
        $salaries = Salary::with('employee.department', 'employee.role')->paginate(10);
        return view('admin.salary.index', compact('salaries'));
    }

    public function create()
    {
        $employees = Employee::with('department', 'role')->get();
        return view('admin.salary.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,employee_id',
            'basic_salary' => 'required|numeric|min:0',
            'allowances' => 'nullable|numeric|min:0',
            'deductions' => 'nullable|numeric|min:0',
            'tax_percentage' => 'nullable|numeric|min:0|max:100'
        ]);

        // Check if salary already exists for this employee
        $existingSalary = Salary::where('employee_id', $request->employee_id)->first();
        if ($existingSalary) {
            return redirect()->back()->with('error', 'Salary already exists for this employee. Please update instead.');
        }

        Salary::create($request->all());

        return redirect()->route('admin.salary.index')->with('success', 'Salary created successfully.');
    }

    public function edit($id)
    {
        $salary = Salary::with('employee')->findOrFail($id);
        return view('admin.salary.edit', compact('salary'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'basic_salary' => 'required|numeric|min:0',
            'allowances' => 'nullable|numeric|min:0',
            'deductions' => 'nullable|numeric|min:0',
            'tax_percentage' => 'nullable|numeric|min:0|max:100'
        ]);

        $salary = Salary::findOrFail($id);
        $salary->update($request->all());

        return redirect()->route('admin.salary.index')->with('success', 'Salary updated successfully.');
    }

    public function destroy($id)
    {
        $salary = Salary::findOrFail($id);
        $salary->delete();

        return redirect()->route('admin.salary.index')->with('success', 'Salary deleted successfully.');
    }
}


