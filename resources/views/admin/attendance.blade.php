@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Attendance </h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Add Attendance Form -->
    <form action="{{ route('attendance.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="row">
            <div class="col-md-3">
                <select name="employee_id" class="form-select" required>
                    <option value="">Select Employee</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->employee_id }}">{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input type="date" name="date" class="form-control" required>
            </div>
            <div class="col-md-2">
                <input type="time" name="check_in" class="form-control" placeholder="Check In">
            </div>
            <div class="col-md-2">
                <input type="time" name="check_out" class="form-control" placeholder="Check Out">
            </div>
            <div class="col-md-2">
                <select name="status" class="form-select" required>
                    <option value="Present">Present</option>
                    <option value="Absent">Absent</option>
                    <option value="Leave">Leave</option>
                    <option value="Late">Late</option>
                </select>
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-success">Add</button>
            </div>
        </div>
    </form>

    <!-- Attendance Table -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Employee</th>
                <th>Date</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Working Hours</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $attendance)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $attendance->employee->name }}</td>
                    <td>{{ $attendance->date }}</td>
                    <td>{{ $attendance->check_in ?? '-' }}</td>
                    <td>{{ $attendance->check_out ?? '-' }}</td>
                    <td>{{ $attendance->working_hours }}</td>
                    <td>{{ $attendance->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
