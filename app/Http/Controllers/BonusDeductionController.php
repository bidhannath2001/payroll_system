<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\BonusDeduction;
use Illuminate\Http\Request;

class BonusDeductionController extends Controller
{
    public function index()
    {
        $bonusDeductions = BonusDeduction::with('employee.department', 'employee.role')->paginate(10);
        return view('admin.bonus_deduction.index', compact('bonusDeductions'));
    }

    public function create()
    {
        $employees = Employee::with('department', 'role')->get();
        return view('admin.bonus_deduction.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,employee_id',
            'type' => 'required|in:Bonus,Deduction',
            'amount' => 'required|numeric|min:0',
            'reason' => 'nullable|string|max:255',
            'date' => 'required|date'
        ]);

        BonusDeduction::create($request->all());

        return redirect()->route('admin.bonus_deduction.index')->with('success', 'Record created successfully.');
    }

    public function edit($id)
    {
        $bonusDeduction = BonusDeduction::with('employee')->findOrFail($id);
        $employees = Employee::with('department', 'role')->get();
        return view('admin.bonus_deduction.edit', compact('bonusDeduction', 'employees'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,employee_id',
            'type' => 'required|in:Bonus,Deduction',
            'amount' => 'required|numeric|min:0',
            'reason' => 'nullable|string|max:255',
            'date' => 'required|date'
        ]);

        $bonusDeduction = BonusDeduction::findOrFail($id);
        $bonusDeduction->update($request->all());

        return redirect()->route('admin.bonus_deduction.index')->with('success', 'Record updated successfully.');
    }

    public function destroy($id)
    {
        $bonusDeduction = BonusDeduction::findOrFail($id);
        $bonusDeduction->delete();

        return redirect()->route('admin.bonus_deduction.index')->with('success', 'Record deleted successfully.');
    }
}


