<aside class="sidebar p-4 d-flex flex-column">
    <h4 class="text-center text-primary fw-bold mb-4 border-bottom pb-3">Payroll System</h4>
    <nav class="sidebar-nav">
        <ul class="nav flex-column">

            {{-- Dashboard --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.admin') ? 'active rounded' : '' }}"
                   href="{{ route('admin.admin') }}">
                    <i class="bi bi-grid-fill me-2"></i>Dashboard
                </a>
            </li>

            {{-- Job Desk --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('jobdesk.*') ? 'active rounded' : '' }}" href="#">
                    <i class="bi bi-person-workspace me-2"></i>Job Desk
                </a>
            </li>

            {{-- Employee --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.employee_list') ? 'active rounded' : '' }}"
                   href="{{ route('admin.employee_list') }}">
                    <i class="bi bi-people-fill me-2"></i>Employee
                </a>
            </li>

            {{-- Leave --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.leave_requests') ? 'active rounded' : '' }}"
                   href="{{ route('admin.leave_requests') }}">
                    <i class="bi bi-calendar-minus me-2"></i>Leave Req
                </a>
            </li>

            {{-- Attendance --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('attendance.index') ? 'active rounded' : '' }}"
                   href="{{ route('attendance.index') }}">
                    <i class="bi bi-clock-fill me-2"></i>Attendance
                </a>
            </li>

            {{-- Setting --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('settings.*') ? 'active rounded' : '' }}" href="#">
                    <i class="bi bi-gear-fill me-2"></i>Setting
                </a>
            </li>

        </ul>
    </nav>
</aside>
