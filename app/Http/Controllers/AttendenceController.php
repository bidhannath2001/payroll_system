<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendence;
use App\Models\Employee;

class AttendenceController extends Controller
{
    // Show attendance page and list all records
    public function index()
    {
        $attendances = Attendence::with('employee')->orderBy('date', 'desc')->get();
        $employees = Employee::all(); // for the form
        // dd($employees);
        return view('admin.attendance', compact('attendances', 'employees'));
    }

    // Store new attendance
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'employee_id' => 'required|exists:employees,employee_id',
            'date' => 'required|date',
            'check_in' => 'nullable|date_format:H:i',
            'check_out' => 'nullable|date_format:H:i',
            'status' => 'required|in:Present,Absent,Leave,Late',
        ]);

        $working_hours = 0;
        if ($request->check_in && $request->check_out) {
            $checkIn = strtotime($request->check_in);
            $checkOut = strtotime($request->check_out);
            $working_hours = round(($checkOut - $checkIn) / 3600, 2);
        }

        Attendence::create([
            'employee_id' => $request->employee_id,
            'date' => $request->date,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'working_hours' => $working_hours,
            'status' => $request->status,
        ]);

        return redirect()->route('attendance.index')->with('success', 'Attendance added successfully.');
    }
}
