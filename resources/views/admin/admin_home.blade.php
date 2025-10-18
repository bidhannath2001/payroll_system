<div class="main-content">
    <header class="d-flex justify-content-between align-items-center mb-4 p-4 rounded bg-white shadow-sm py-4">
        <h1 class="h3 mb-0">Dashboard</h1>
        <div class="d-flex align-items-center gap-2">
            <span class="text-muted small">Welcome, {{ $adminName ?? 'Admin' }}</span>
        </div>
    </header>
    <main>
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 mb-4">
            <div class="card p-4 shadow-sm flex-grow-1">
                <div class="d-flex align-items-center">
                    <img src="{{ $adminPhotoUrl ?? 'https://ui-avatars.com/api/?name=Admin&size=60&background=007bff&color=ffffff' }}" 
                         alt="{{ $adminName ?? 'Admin' }}" 
                         class="rounded-circle me-3" 
                         style="width:60px;height:60px;object-fit:cover;border:3px solid #e9ecef;">
                    <div>
                        <h5 class="fw-bold mb-1">Good to see you, {{ $adminName ?? 'Admin' }}</h5>
                        <p class="text-muted mb-0">You came 15 minutes early today.</p>
                    </div>
                </div>
            </div>
            <div class="d-flex gap-3 punch-card p-3">
                <div class="d-flex flex-column align-items-center">
                    <div class="punch-status-indicator-in mb-2"></div>
                    <span class="time">9:00 AM</span>
                    <small class="text-muted">Punch In</small>
                </div>
                <div class="d-flex flex-column align-items-center">
                    <div class="punch-status-indicator-out mb-2"></div>
                    <span class="time">05:00 PM</span>
                    <small class="text-muted">Punch Out</small>
                </div>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-lg-3 col-md-6">
                <div class="card p-3 shadow-sm summary-card">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <small class="text-muted">Total Employee</small>
                            <h2 class="fw-bold my-2 mb-0">{{ $totalUsers }}</h2>
                        </div>
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10" style="width:48px;height:48px;">
                            <i class="bi bi-people-fill text-primary fs-5"></i>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card p-3 shadow-sm summary-card">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <small class="text-muted">Total Active Employee</small>
                            <h2 class="fw-bold my-2 mb-0">{{ $activeUsers }}</h2>
                        </div>
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10" style="width:48px;height:48px;">
                            <i class="bi bi-person-check-fill text-success fs-5"></i>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card p-3 shadow-sm summary-card">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <small class="text-muted">Total Monthly Cost</small>
                            <h2 class="fw-bold my-2 mb-0">{{ number_format($monthlycost, 2) }}</h2>
                        </div>
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center bg-warning bg-opacity-10" style="width:48px;height:48px;">
                            <i class="bi bi-cash-stack text-warning fs-5"></i>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card p-3 shadow-sm summary-card">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <small class="text-muted">Total leave request</small>
                            <h2 class="fw-bold my-2 mb-0">{{ $leaverequests }}</h2>
                        </div>
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center bg-info bg-opacity-10" style="width:48px;height:48px;">
                            <i class="bi bi-calendar2-check-fill text-info fs-5"></i>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <!-- Salary Breakdown Pie Chart -->
            <div class="col-md-6">
                <div class="card p-4 shadow-sm h-100">
                    <h5 class="card-title border-bottom pb-3 mb-4">Salary Breakdown</h5>
                    
                    <div class="chart-container" style="position: relative; height: 300px;">
                        <canvas id="salaryPieChart"></canvas>
                    </div>
                    
                    <!-- Legend -->
                    <div class="row mt-3">
                        <div class="col-6 mb-2">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle me-2" style="width: 12px; height: 12px; background-color: #28a745;"></div>
                                <small class="text-muted">🟢 Basic Salary</small>
                            </div>
                        </div>
                        <div class="col-6 mb-2">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle me-2" style="width: 12px; height: 12px; background-color: #007bff;"></div>
                                <small class="text-muted">🔵 Allowances</small>
                            </div>
                        </div>
                        <div class="col-6 mb-2">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle me-2" style="width: 12px; height: 12px; background-color: #6f42c1;"></div>
                                <small class="text-muted">🟣 Bonuses</small>
                            </div>
                        </div>
                        <div class="col-6 mb-2">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle me-2" style="width: 12px; height: 12px; background-color: #dc3545;"></div>
                                <small class="text-muted">🔴 Deductions</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Employees By Department Chart -->
            <div class="col-md-6">
                <div class="card p-4 shadow-sm h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">Employees By Department</h5>
                        <div class="d-flex align-items-center text-muted">
                            <i class="bi bi-calendar-week me-1"></i>
                            <small>This Week</small>
                        </div>
                    </div>
                    
                    <div class="chart-container" style="position: relative; height: 300px;">
                        <canvas id="departmentChart"></canvas>
                    </div>
                    
                    <div class="mt-3 d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="bg-warning rounded-circle me-2" style="width: 8px; height: 8px;"></div>
                            <small class="text-muted">No of Employees increased by +20% from last Week</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <!-- Recent Attendance -->
            <div class="col-md-6">
                <div class="card p-4 shadow-sm h-100">
                    <h5 class="card-title border-bottom pb-3 mb-4">Recent Attendance</h5>
                    <div class="list-group list-group-flush">
                        @forelse($recentAttendance as $attendance)
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div>
                                    <h6 class="mb-1">{{ $attendance->employee->first_name }} {{ $attendance->employee->last_name }}</h6>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($attendance->date)->format('M d, Y') }}</small>
                                </div>
                                <span class="badge bg-{{ $attendance->status == 'Present' ? 'success' : ($attendance->status == 'Absent' ? 'danger' : 'warning') }} rounded-pill">
                                    {{ $attendance->status }}
                                </span>
                            </div>
                        @empty
                            <div class="text-center text-muted py-3">
                                <i class="bi bi-calendar-x fs-1"></i>
                                <p class="mt-2">No recent attendance records</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- System Overview -->
            <div class="col-md-6">
                <div class="card p-4 shadow-sm h-100">
                    <h5 class="card-title border-bottom pb-3 mb-4">System Overview</h5>
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="text-center p-3 bg-light rounded">
                                <div class="d-flex align-items-center justify-content-center mb-2">
                                    <i class="bi bi-building text-primary fs-4"></i>
                                </div>
                                <h4 class="text-primary mb-1">{{ $totalDepartments }}</h4>
                                <small class="text-muted">Departments</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center p-3 bg-light rounded">
                                <div class="d-flex align-items-center justify-content-center mb-2">
                                    <i class="bi bi-shield-check text-success fs-4"></i>
                                </div>
                                <h4 class="text-success mb-1">{{ $totalRoles }}</h4>
                                <small class="text-muted">Roles</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center p-3 bg-light rounded">
                                <div class="d-flex align-items-center justify-content-center mb-2">
                                    <i class="bi bi-calculator text-warning fs-4"></i>
                                </div>
                                <h4 class="text-warning mb-1">{{ $thisMonthPayrolls }}</h4>
                                <small class="text-muted">This Month Payrolls</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center p-3 bg-light rounded">
                                <div class="d-flex align-items-center justify-content-center mb-2">
                                    <i class="bi bi-clock text-info fs-4"></i>
                                </div>
                                <h4 class="text-info mb-1">{{ $workinghours ?? 0 }}</h4>
                                <small class="text-muted">Total Hours</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Leave Requests -->
        <div class="card p-4 shadow-sm">
            <h5 class="card-title border-bottom pb-3 mb-4">Pending Leave Requests</h5>
            <div class="list-group list-group-flush">
                @forelse($pendingLeaveRequests as $leave)
                    <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <div>
                            <h6 class="mb-1">{{ $leave->employee->first_name }} {{ $leave->employee->last_name }}</h6>
                            <small class="text-muted">{{ $leave->leave_type }} - {{ \Carbon\Carbon::parse($leave->start_date)->format('M d') }} to {{ \Carbon\Carbon::parse($leave->end_date)->format('M d') }}</small>
                        </div>
                        <span class="badge bg-warning rounded-pill">Pending</span>
                    </div>
                @empty
                    <div class="text-center text-muted py-3">
                        <i class="bi bi-check-circle fs-1"></i>
                        <p class="mt-2">No pending leave requests</p>
                    </div>
                @endforelse
            </div>
            @if($pendingLeaveRequests->count() > 0)
                <div class="mt-3">
                    <a href="{{ route('admin.leave_requests') }}" class="btn btn-outline-primary btn-sm">View All Requests</a>
                </div>
            @endif
        </div>
    </main>
</div>