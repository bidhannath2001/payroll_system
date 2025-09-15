<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveRequestController extends Controller
{
    // Store leave request
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'leave_type' => 'required|string|max:50',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date'   => 'required|date|after_or_equal:start_date',
            'reason'     => 'required|string|max:1200',
        ]);
        $user = session('user');
        $employee = Employee::find($user->employee_id);

        $leaveDays = \Carbon\Carbon::parse($request->start_date)
            ->diffInDays(\Carbon\Carbon::parse($request->end_date)) + 1;

        if ($employee->available_leave < $leaveDays) {
            return back()->withErrors(['leave' => 'You do not have enough available leaves.']);
        }

        // Store request
        $leave = new LeaveRequest();
        $leave->employee_id = $employee->employee_id;
        $leave->leave_type  = $request->leave_type;
        $leave->start_date  = $request->start_date;
        $leave->end_date    = $request->end_date;
        $leave->reason      = $request->reason;
        $leave->status      = 'Pending';
        $leave->save();

        return redirect()->route('employee.leave_request')->with('success', 'Leave request submitted successfully!');
    }
    public function history()
    {
        $user = session('user');
        $employee = Employee::find($user->employee_id);
        $leaveRequests = LeaveRequest::where('employee_id', $employee->employee_id)->get();
        return view('employee.leave_request_history', compact('leaveRequests','employee'));
    }
    public function adminIndex()
    {
        $pendingRequests = LeaveRequest::with('employee')->where('status', 'pending')->latest()->get();
        $approvedRequests = LeaveRequest::with('employee')->where('status', 'approved')->latest()->get();
        $rejectedRequests = LeaveRequest::with('employee')->where('status', 'rejected')->latest()->get();

        return view('admin.leave_requests', compact('pendingRequests', 'approvedRequests', 'rejectedRequests'));
    }
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $leave = LeaveRequest::findOrFail($id);
        $leave->status = $request->status;
        $leave->save();

        if ($request->status === 'approved') {
            $employee = Employee::find($leave->employee_id);
            $days = \Carbon\Carbon::parse($leave->start_date)->diffInDays(\Carbon\Carbon::parse($leave->end_date)) + 1;
            $employee->available_leave = max(0, $employee->available_leave - $days);
            $employee->save();
        }

        return redirect()->back()->with('success', 'Leave request updated successfully!');
    }
}
