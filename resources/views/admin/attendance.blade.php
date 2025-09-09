<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        table th, table td { text-align: center; vertical-align: middle; }
        .main-content { margin-left: 250px; padding: 20px; } 
    </style>
</head>
<body>
    
    <!-- Include Sidebar -->
    @include('admin.sidebar')

    <div class="main-content">
        <h2 class="mb-4">Attendance</h2>
         
        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Add Attendance Form -->
        <form action="{{ route('attendance.store') }}" method="POST" class="mb-4">
            @csrf
            <div class="row g-2">
                <div class="col-md-3">
                    <select name="employee_id" class="form-select" required>
                        <option value="">Select Employee</option>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->employee_id }}">
                                {{ $employee->first_name }} {{ $employee->last_name }}
                            </option>
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
                <div class="col-md-1 d-grid">
                    <button type="submit" class="btn btn-success">Add</button>
                </div>
            </div>
        </form>

        <!-- Attendance Table -->
        <table class="table table-bordered table-striped mt-3">
            <thead class="table-dark">
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
                @forelse($attendances as $attendance)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $attendance->employee->first_name }} {{ $attendance->employee->last_name }}</td>
                        <td>{{ $attendance->date }}</td>
                        <td>{{ $attendance->check_in ?? '-' }}</td>
                        <td>{{ $attendance->check_out ?? '-' }}</td>
                        <td>{{ $attendance->working_hours }}</td>
                        <td>{{ $attendance->status }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">No attendance records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
