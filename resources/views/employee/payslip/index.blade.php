<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Payslips - Payroll System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/employee.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
                            <a class="nav-link" href="{{ route('employee.payslip.index') }}">My Payslips</a>
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
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">My Payslips</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Month/Year</th>
                                    <th>Gross Salary</th>
                                    <th>Total Deductions</th>
                                    <th>Bonuses</th>
                                    <th>Net Salary</th>
                                    <th>Generated At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($payrolls as $payroll)
                                    <tr>
                                        <td><strong>{{ $payroll->month_name }} {{ $payroll->year }}</strong></td>
                                        <td>Tk. {{ number_format($payroll->gross_salary, 2) }}</td>
                                        <td>Tk. {{ number_format($payroll->total_deductions, 2) }}</td>
                                        <td>Tk. {{ number_format($payroll->bonuses, 2) }}</td>
                                        <td><strong>Tk. {{ number_format($payroll->net_salary, 2) }}</strong></td>
                                        <td>{{ \Carbon\Carbon::parse($payroll->generated_at)->format('M d, Y H:i') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('employee.payslip.show', $payroll->payroll_id) }}" 
                                                   class="btn btn-info btn-sm" title="View">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('employee.payslip.download', $payroll->payroll_id) }}" 
                                                   class="btn btn-success btn-sm" title="Download">
                                                    <i class="bi bi-download"></i> 
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No payslips available.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center">
                        {{ $payrolls->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    </main>

    <footer class="text-center py-3">
        <small>© {{ now()->year }} Payroll Management System. All rights reserved.</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
