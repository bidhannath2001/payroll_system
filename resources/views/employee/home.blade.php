<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f6fa;
        }

        .card {
            border: none;
        }

        .profile-header {
            background: linear-gradient(135deg, #007bff, #00b4d8);
            height: 150px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .profile-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border: 4px solid #fff;
            border-radius: 50%;
            margin-top: -60px;
            background-color: #fff;
        }

        .nav-tabs {
            border: none;
            justify-content: space-around;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .nav-tabs .nav-link {
            border: none;
            color: #6c757d;
            font-weight: 600;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-tabs .nav-link.active {
            color: #0d6efd;
            border-bottom: 3px solid #0d6efd;
            background-color: #f0f8ff;
        }

        .tab-content .card {
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        }

        .info-label {
            color: #6c757d;
            font-weight: 500;
        }

        .info-value {
            font-weight: 600;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="{{ url('employee/home') }}">Payroll System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    @if (session()->has('user'))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="leaveDropdown" role="button"
                                data-bs-toggle="dropdown">
                                Leave Request
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('employee.leave_request') }}">New
                                        Request</a></li>
                                <li><a class="dropdown-item"
                                        href="{{ route('employee.leave_request_history') }}">Request History</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('employee.payslip.index') }}">My
                                Payslips</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('employee.edit_profile') }}">Profile</a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST">@csrf
                                <button class="btn btn-link nav-link">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        @if (isset($employee))
            <div class="row g-4">
                <!-- Left Profile -->
                <div class="col-md-4">
                    <div class="card shadow-lg text-center">
                        <div class="profile-header"></div>
                        <div class="card-body">
                            @if ($employee->id_proof)
                                <img src="{{ asset('storage/' . $employee->id_proof) }}" class="profile-img"
                                    alt="Profile Image">
                            @else
                                <img src="{{ asset('images/default-profile.png') }}" class="profile-img"
                                    alt="Default Profile">
                            @endif
                            <h5 class="mt-3">{{ $employee->first_name }} {{ $employee->last_name }}</h5>
                            <p class="text-muted">{{ $employee->designation }}</p>
                            <hr>
                            <p><i class="bi bi-envelope"></i> {{ $employee->email }}</p>
                            <p><i class="bi bi-telephone"></i> {{ $employee->phone }}</p>
                            <p><i class="bi bi-geo-alt"></i> {{ $employee->address }}</p>
                            <p><i class="bi bi-calendar-check"></i> Joined: {{ $employee->date_joined }}</p>
                            <span class="badge bg-success">{{ $employee->status }}</span>
                            <hr>
                            <div class="d-flex justify-content-around">
                                @if ($employee->id_proof)
                                    <a href="{{ asset('storage/' . $employee->id_proof) }}" target="_blank"
                                        class="btn btn-outline-primary btn-sm"><i class="bi bi-card-image"></i> ID
                                        Proof</a>
                                @else
                                    <span class="text-muted small">No ID</span>
                                @endif

                                @if ($employee->resume)
                                    <a href="{{ asset('storage/' . $employee->resume) }}" target="_blank"
                                        class="btn btn-outline-success btn-sm"><i class="bi bi-file-earmark-text"></i>
                                        Resume</a>
                                @else
                                    <span class="text-muted small">No Resume</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side Tabs -->
                <div class="col-md-8">
                    <ul class="nav nav-tabs" id="profileTabs" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" id="personal-tab" data-bs-toggle="tab"
                                data-bs-target="#personal" type="button">
                                <i class="bi bi-person-circle"></i> Personal Information
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="job-tab" data-bs-toggle="tab" data-bs-target="#job"
                                type="button">
                                <i class="bi bi-briefcase"></i> Job Information
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="attendance-tab" data-bs-toggle="tab"
                                data-bs-target="#attendance" type="button">
                                <i class="bi bi-calendar-check"></i> Attendance
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="jobdesk-tab" data-bs-toggle="tab" data-bs-target="#jobdesk"
                                type="button">
                                <i class="bi bi-person-workspace"></i> Job Desk
                            </button>
                        </li>

                    </ul>

                    <div class="tab-content mt-3">
                        <!-- Personal Information Tab -->
                        <div class="tab-pane fade show active" id="personal">
                            <div class="card p-3">
                                <h5 class="fw-bold text-primary mb-3"><i class="bi bi-person-lines-fill"></i> Personal
                                    Details</h5>
                                <div class="row">
                                    <div class="col-md-6"><span class="info-label">Date of Birth:</span> <span
                                            class="info-value">{{ $employee->dob }}</span></div>
                                    <div class="col-md-6"><span class="info-label">Gender:</span> <span
                                            class="info-value">{{ ucfirst($employee->gender) }}</span></div>
                                    <div class="col-md-6"><span class="info-label">Phone:</span> <span
                                            class="info-value">{{ $employee->phone }}</span></div>
                                    <div class="col-md-6"><span class="info-label">Email:</span> <span
                                            class="info-value">{{ $employee->email }}</span></div>
                                    <div class="col-md-12"><span class="info-label">Address:</span> <span
                                            class="info-value">{{ $employee->address }}</span></div>
                                </div>
                            </div>
                        </div>

                        <!-- Job Information Tab -->
                        <div class="tab-pane fade" id="job">
                            <div class="card p-3">
                                <h5 class="fw-bold text-primary mb-3"><i class="bi bi-building"></i> Job Information
                                </h5>
                                <div class="row">
                                    <div class="col-md-6"><span class="info-label">Designation:</span> <span
                                            class="info-value">{{ $employee->designation }}</span></div>
                                    <div class="col-md-6"><span class="info-label">Department ID:</span> <span
                                            class="info-value">{{ $employee->department_id }}</span></div>
                                    <div class="col-md-6"><span class="info-label">Role ID:</span> <span
                                            class="info-value">{{ $employee->role_id }}</span></div>
                                    <div class="col-md-6"><span class="info-label">Date Joined:</span> <span
                                            class="info-value">{{ $employee->date_joined }}</span></div>
                                    <div class="col-md-12"><span class="info-label">Status:</span> <span
                                            class="badge bg-success">{{ $employee->status }}</span></div>
                                </div>
                            </div>
                        </div>

                        <!-- Attendance Tab -->
                        <div class="tab-pane fade" id="attendance">
                            <div class="card p-3">
                                <h5 class="fw-bold text-primary mb-3">
                                    <i class="bi bi-calendar-week"></i> Attendance Overview
                                </h5>

                                <!-- Attendance Details -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Present Days:</strong> {{ $presentDays ?? 0 }}</p>
                                        <p><strong>Absent Days:</strong> {{ $absentDays ?? 0 }}</p>
                                        <p><strong>Last Check-In:</strong>
                                            {{ $lastCheckInDate ? \Carbon\Carbon::parse($lastCheckInDate)->format('M d, Y') : 'N/A' }}
                                        </p>
                                    </div>

                                    <!-- Pie Chart -->
                                    <div class="col-md-12 text-center">
                                        <div style="max-width: 250px; margin: 0 auto;">
                                            <canvas id="attendanceChart"></canvas>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- job desk Tab -->
                        <div class="tab-pane fade" id="jobdesk">
                            <div class="card p-3">
                                <h5 class="fw-bold text-primary mb-3"><i class="bi bi-person-workspace"></i> Job Desk
                                </h5>
                                {{-- <p><strong>Present Days:</strong> {{ $presentDays ?? 0 }}</p>
                                <p><strong>Absent Days:</strong> {{ $absentDays ?? 0 }}</p>
                                <p><strong>Last Check-In:</strong> {{ $lastCheckInDate ? \Carbon\Carbon::parse($lastCheckInDate)->format('M d, Y') : 'N/A' }}</p> --}}
                                <ul>
                                    <li>Available Job</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-warning text-center">
                Employee record not found for this user.
            </div>
        @endif
    </main>

    <footer class="text-center py-3">
        <small>© {{ now()->year }} Payroll Management System. All rights reserved.</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('attendanceChart').getContext('2d');
            const present = {{ $presentDays ?? 0 }};
            const absent = {{ $absentDays ?? 0 }};

            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Present', 'Absent'],
                    datasets: [{
                        data: [present, absent],
                        backgroundColor: ['#28a745', '#dc3545'],
                        borderColor: ['#ffffff', '#ffffff'],
                        borderWidth: 2
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom',
                            labels: {
                                font: {
                                    size: 14
                                },
                                color: '#333'
                            }
                        },
                        title: {
                            display: true,
                            text: 'Attendance Ratio',
                            font: {
                                size: 16,
                                weight: 'bold'
                            },
                            color: '#0d6efd'
                        }
                    }
                }
            });
        });
    </script>

</body>

</html>
