<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payslip Details - Payroll System</title>
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
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Payslip Details</h3>
                    <a href="{{ route('employee.payslip.download', $payroll->payroll_id) }}" class="btn btn-success">
                        <i class="fas fa-download"></i> Download Payslip
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Employee Information</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Name  : </strong></td>
                                    <td>{{ $payroll->employee->first_name }} {{ $payroll->employee->last_name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Designation :</strong></td>
                                    <td>{{ $payroll->employee->designation }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Department :</strong></td>
                                    <td>{{ $payroll->employee->department->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email :</strong></td>
                                    <td>{{ $payroll->employee->email }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Payroll Information</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Period :</strong></td>
                                    <td>{{ $payroll->month_name }} {{ $payroll->year }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Generated At :</strong></td>
                                    <td>{{ \Carbon\Carbon::parse($payroll->generated_at)->format('M d, Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <h5>Attendance Summary</h5>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td><strong>Present Days</strong></td>
                                        <td class="text-right">{{ $presentDays ?? 0 }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Absent Days</strong></td>
                                        <td class="text-right">{{ $absentDays ?? 0 }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Total Working Days</strong></td>
                                        <td class="text-right">{{ $totalDays ?? 0 }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Base Salary Information</h5>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td><strong>Basic Salary </strong></td>
                                        <td class="text-right">Tk. {{ number_format($salary->basic_salary ?? 0, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Allowances </strong></td>
                                        <td class="text-right">Tk. {{ number_format($salary->allowances ?? 0, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Base Deductions </strong></td>
                                        <td class="text-right">Tk. {{ number_format($salary->deductions ?? 0, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tax Percentage</strong></td>
                                        <td class="text-right">{{ $salary->tax_percentage ?? 0 }}%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-8">
                            <h5>Salary Breakdown</h5>
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Description</th>
                                        <th class="text-right">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Basic Salary</td>
                                        <td class="text-right">Tk. {{ number_format($salary->basic_salary ?? 0, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Allowances</td>
                                        <td class="text-right">Tk. {{ number_format($salary->allowances ?? 0, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Gross Salary</td>
                                        <td class="text-right">Tk. {{ number_format($payroll->gross_salary, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Bonuses</td>
                                        <td class="text-right">Tk. {{ number_format($payroll->bonuses, 2) }}</td>
                                    </tr>
                                    <tr class="table-danger">
                                        <td><strong>Total Deductions</strong></td>
                                        <td class="text-right"><strong>Tk. {{ number_format($payroll->total_deductions, 2) }}</strong></td>
                                    </tr>
                                    <tr class="table-success">
                                        <td><strong>Net Salary</strong></td>
                                        <td class="text-right"><strong>Tk. {{ number_format($payroll->net_salary, 2) }}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if(isset($bonusDetails) && $bonusDetails->count() > 0)
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h5>Bonus Details</h5>
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Reason</th>
                                        <th class="text-right">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bonusDetails as $bonus)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($bonus->date)->format('M d, Y') }}</td>
                                        <td>{{ $bonus->reason ?? 'N/A' }}</td>
                                        <td class="text-right">Tk. {{ number_format($bonus->amount, 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif

                    @if(isset($deductionDetails) && $deductionDetails->count() > 0)
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h5>Deduction Details</h5>
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Reason</th>
                                        <th class="text-right">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($deductionDetails as $deduction)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($deduction->date)->format('M d, Y') }}</td>
                                        <td>{{ $deduction->reason ?? 'N/A' }}</td>
                                        <td class="text-right">Tk. {{ number_format($deduction->amount, 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif

                    <div class="mt-3">
                        <a href="{{ route('employee.payslip.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to My Payslips
                        </a>
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
