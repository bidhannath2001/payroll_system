<aside class="sidebar p-4 d-flex flex-column">
    <h4 class="text-center text-primary fw-bold mb-4 border-bottom pb-3">PUC</h4>
    <nav class="sidebar-nav">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active rounded" href="#"><i class="bi bi-grid-fill me-2"></i>Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="bi bi-person-workspace me-2"></i>Job Desk</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="collapse"
                    data-bs-target="#employeeSubmenu">
                    <i class="bi bi-people-fill me-2"></i>Employee
                </a>
                <div class="collapse" id="employeeSubmenu">
                    <ul class="nav flex-column ms-4">
                        <li class="nav-item"><a class="nav-link" href="#">Employee List</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('admin.create')}}">Add New</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="collapse"
                    data-bs-target="#leaveSubmenu">
                    <i class="bi bi-calendar-minus me-2"></i>Leave
                </a>
                <div class="collapse" id="leaveSubmenu">
                    <ul class="nav flex-column ms-4">
                        <li class="nav-item"><a class="nav-link" href="#">Leave Request</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Leave Balance</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="bi bi-clock-fill me-2"></i>Attendance</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="bi bi-gear-fill me-2"></i>Setting</a>
            </li>
        </ul>
    </nav>
</aside>
