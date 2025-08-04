@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <div>
            <h2 class="mb-0">Welcome, {{ $employee['name'] ?? 'Employee' }}</h2>
            {{-- <p class="text-muted mb-0">Your Dashboard</p> --}}
        </div>
        <div class="mt-3 mt-md-0">
            {{-- <a href="{{ route('employee.profile.edit') }}" class="btn btn-outline-info btn-sm me-2">Edit Profile</a> --}}
            {{-- <form action="{{ route('logout') }}" method="POST" class="d-inline"> --}}
                @csrf
                <button class="btn btn-outline-success btn-sm">Action</button>
            </form>
        </div>
    </div>

    <div class="row g-4">
        <!-- Profile & Attendance -->
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-primary text-white">Profile & Attendance</div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ $employee['name'] }}</p>
                    <p><strong>Email:</strong> {{ $employee['email'] }}</p>
                    <p><strong>Department:</strong> {{ $employee['department'] }}</p>
                    <hr>
                    <h6 class="text-primary">Attendance</h6>
                    <p><strong>Present Days:</strong> {{ $attendance['present_days'] }}</p>
                    <p><strong>Absent Days:</strong> {{ $attendance['absent_days'] }}</p>
                    <p><strong>Last Check-In:</strong> {{ $attendance['last_check_in'] }}</p>
                </div>
            </div>
        </div>

        <!-- Pay-slips -->
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-success text-white">Pay-slips</div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead class="table-light">
                            <tr>
                                <th>Month</th>
                                <th>Year</th>
                                <th>Download</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payslips as $payslip)
                            <tr>
                                <td>{{ $payslip['month'] }}</td>
                                <td>{{ $payslip['year'] }}</td>
                                <td>
                                    {{-- <a href="{{ route('employee.payslip.download', $payslip['id']) }}" class="btn btn-sm btn-outline-primary">Download</a> --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
