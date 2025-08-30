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
            {{-- Employee Dropdown --}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.employee_list') || request()->routeIs('admin.create') ? 'active rounded' : '' }}"
                    href="#" role="button" data-bs-toggle="collapse" data-bs-target="#employeeSubmenu"
                    aria-expanded="{{ request()->routeIs('admin.employee_list') || request()->routeIs('admin.create') ? 'true' : 'false' }}">
                    <i class="bi bi-people-fill me-2"></i>Employee
                </a>
                <div class="collapse {{ request()->routeIs('admin.employee_list') || request()->routeIs('admin.create') ? 'show' : '' }}"
                    id="employeeSubmenu">
                    <ul class="nav flex-column ms-4">
                        <li class="nav-item">
                            <a class="nav-link"
                                style="{{ request()->routeIs('admin.employee_list') ? 'color: blue' : '' }}"
                                href="{{ route('admin.employee_list') }}">
                                Employee List
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                style="{{ request()->routeIs('admin.create') ? 'color: blue' : '' }}"
                                href="{{ route('admin.create') }}">
                                Add New
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            {{-- Leave Dropdown --}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ request()->routeIs('leave.request') || request()->routeIs('leave.balance') ? 'active rounded' : '' }}"
                    href="#" role="button" data-bs-toggle="collapse" data-bs-target="#leaveSubmenu"
                    aria-expanded="{{ request()->routeIs('leave.request') || request()->routeIs('leave.balance') ? 'true' : 'false' }}">
                    <i class="bi bi-calendar-minus me-2"></i>Leave
                </a>
                <div class="collapse {{ request()->routeIs('leave.request') || request()->routeIs('leave.balance') ? 'show' : '' }}"
                    id="leaveSubmenu">
                    <ul class="nav flex-column ms-4">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('leave.request') ? 'active rounded' : '' }}"
                                href="#">
                                Leave Request
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('leave.balance') ? 'active rounded' : '' }}"
                                href="#">
                                Leave Balance
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            {{-- Attendance --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('attendance.*') ? 'active rounded' : '' }}" href="#">
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
