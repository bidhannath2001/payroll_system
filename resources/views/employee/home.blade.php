<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/employee.css') }}" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Payroll System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    @if (session()->has('user'))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="leaveDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Leave Request
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="leaveDropdown">
                                <li><a class="dropdown-item" href="{{ route('employee.leave_request') }}">New
                                        Request</a></li>
                                <li><a class="dropdown-item"
                                        href="{{ route('employee.leave_request_history') }}">Request History</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('employee.edit_profile') }}">Profile</a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="btn btn-link nav-link">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        @if (isset($employee))
            <div class="row g-4">
                <!-- Profile -->
                <div class="col-md-6">
                    <div class="card shadow-lg border-0 rounded-3 text-center">
                        <!-- Profile Image -->

                        <div class="card-header bg-primary text-white text-center fs-5 fw-bold">
                            Employee Profile
                        </div>
                        <div class="mt-4">

                            @if ($employee->id_proof)
                                <img src="{{ asset('storage/' . $employee->id_proof) }}" alt="Profile Image"
                                    class="rounded-circle border border-3 border-primary"
                                    style="width: 120px; height: 120px; object-fit: cover;">
                            @else
                                <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile"
                                    class="rounded-circle border border-3 border-primary"
                                    style="width: 120px; height: 120px; object-fit: cover;">
                            @endif
                            {{-- <hr> --}}
                        </div>

                        <div class="card-body p-4 text-start">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p><strong>Name:</strong> {{ $employee->first_name }} {{ $employee->last_name }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Email:</strong> {{ $employee->email }}</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p><strong>Date of Birth:</strong> {{ $employee->dob }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Gender:</strong> {{ ucfirst($employee->gender) }}</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p><strong>Phone:</strong> {{ $employee->phone }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Address:</strong> {{ $employee->address }}</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p><strong>Designation:</strong> {{ $employee->designation }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Department ID:</strong> {{ $employee->department_id }}</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p><strong>Role ID:</strong> {{ $employee->role_id }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Date Joined:</strong> {{ $employee->date_joined }}</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p><strong>Status:</strong>
                                        <span class="badge bg-success">{{ $employee->status }}</span>
                                    </p>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <strong>ID Proof:</strong><br>
                                    @if ($employee->id_proof)
                                        <a href="{{ asset('storage/' . $employee->id_proof) }}" target="_blank"
                                            class="btn btn-sm btn-outline-primary mt-1">View ID Proof</a>
                                    @else
                                        <span class="text-muted">Not Uploaded</span>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-2">
                                    <strong>Resume:</strong><br>
                                    @if ($employee->resume)
                                        <a href="{{ asset('storage/' . $employee->resume) }}" target="_blank"
                                            class="btn btn-sm btn-outline-success mt-1">View Resume</a>
                                    @else
                                        <span class="text-muted">Not Uploaded</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Attendance placeholder -->
                <div class="col-md-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-success text-white">Attendance</div>
                        <div class="card-body">
                            <p><strong>Present Days:</strong> --</p>
                            <p><strong>Absent Days:</strong> --</p>
                            <p><strong>Last Check-In:</strong> --</p>
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
    @yield('scripts')
</body>

</html>
