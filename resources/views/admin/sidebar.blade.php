<aside class="sidebar p-3 d-flex flex-column bg-light position-fixed h-100 shadow-sm"
    style="width: 260px; transition: width 0.3s;">
    <!-- Sidebar Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <button id="sidebarToggle" class="btn btn-outline-primary btn-sm toggle-btn">
            <i class="bi bi-list"></i>
        </button>
        <h4 class="text-primary fw-bold mb-0">Payroll System</h4>
    </div>

    <!-- Sidebar Nav -->
    <nav class="sidebar-nav flex-grow-1 overflow-auto">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.admin') ? 'active rounded' : '' }}"
                    href="{{ route('admin.admin') }}">
                    <i class="bi bi-grid-fill me-2"></i>Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.job.index') ? 'active rounded' : '' }}" href="{{route('admin.job.index')}}">
                    <i class="bi bi-person-workspace me-2"></i>Job Desk
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.employee_list') ? 'active rounded' : '' }}"
                    href="{{ route('admin.employee_list') }}">
                    <i class="bi bi-people-fill me-2"></i>Employee
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.leave_requests') ? 'active rounded' : '' }}"
                    href="{{ route('admin.leave_requests') }}">
                    <i class="bi bi-calendar-minus me-2"></i>Leave Req
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('attendance.index') ? 'active rounded' : '' }}"
                    href="{{ route('attendance.index') }}">
                    <i class="bi bi-clock-fill me-2"></i>Attendance
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.salary.*') ? 'active rounded' : '' }}"
                    href="{{ route('admin.salary.index') }}">
                    <i class="bi bi-currency-dollar me-2"></i>Salary
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.bonus_deduction.*') ? 'active rounded' : '' }}"
                    href="{{ route('admin.bonus_deduction.index') }}">
                    <i class="bi bi-plus-circle me-2"></i>Bon/Ded
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.payroll.*') ? 'active rounded' : '' }}"
                    href="{{ route('admin.payroll.index') }}">
                    <i class="bi bi-receipt me-2"></i>Payroll
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('settings.*') ? 'active rounded' : '' }}" href="#">
                    <i class="bi bi-gear-fill me-2"></i>Setting
                </a>
            </li>
        </ul>
    </nav>
</aside>

<!-- Sidebar Toggle Button (Fixed Outside Sidebar) -->
<button id="sidebarToggleFixed" class="btn btn-primary btn-sm position-fixed toggle-btn-fixed">
    <i class="bi bi-list"></i>
</button>

<!-- JS -->
<script>
    const sidebar = document.querySelector('.sidebar');
    const toggleInside = document.getElementById('sidebarToggle');
    const toggleFixed = document.getElementById('sidebarToggleFixed');

    const toggleSidebar = () => sidebar.classList.toggle('collapsed');

    toggleInside.addEventListener('click', toggleSidebar);
    toggleFixed.addEventListener('click', toggleSidebar);
</script>

<!-- CSS -->
<style>
    .sidebar {
        width: 250px;
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        background: #fff;
        border-right: 1px solid #dee2e6;
        transition: all 0.3s ease;
        z-index: 1050;
    }

    .sidebar.collapsed {
        margin-left: -260px;
    }

    .main-content {
        margin-left: 260px;
        transition: margin-left 0.3s ease;
    }

    .sidebar.collapsed~.main-content {
        margin-left: 0;
    }

    /* Floating toggle button when collapsed */
    .toggle-btn-fixed {
        top: 15px;
        left: 15px;
        z-index: 2001;
        display: none;
        transition: opacity 0.3s ease;
    }

    /* Show floating button when sidebar is collapsed */
    .sidebar.collapsed~.toggle-btn-fixed {
        display: block;
    }

    .sidebar-nav .nav-link {
        border-radius: 0.5rem;
        /* rounded corners like a card */
        transition: all 0.3s ease;
        padding: 0.5rem 1rem;
        color: #495057;
    }

    .sidebar-nav .nav-link:hover {
        background: #e9f5ff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        color: #0d6efd;
        border-left: 4px solid #ffc107;
        border-right: 4px solid #ffc107;


    }
    .sidebar-nav .nav-link:hover i {
    color: #fff;
    background: linear-gradient(135deg, #0d6efd, #6610f2);
    transform: scale(1.2) rotate(10deg);
    box-shadow: 0 6px 15px rgba(0,0,0,0.25);
    filter: drop-shadow(0 0 8px rgba(13,110,253,0.7));
}
    .sidebar-nav .nav-link.active i {
    color: #fff;
    background: #0d6efd;
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    transform: scale(1.15);
}
    /* Optional: keep the active item highlighted */
    .sidebar-nav .nav-link.active {
        background: #0d6efd;
        color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Responsive overlay for mobile */
    @media (max-width: 768px) {
        .sidebar {
            z-index: 2000;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }
    }
</style>
