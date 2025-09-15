<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll Management - Payroll System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <style>
        th,td{
            text-align: center;
        }
    </style>
</head>

<body>

        @include('admin.sidebar')
        <div class="main-content">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Payroll Management</h3>
                <a href="{{ route('admin.payroll.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i> Generate Payroll
                </a>
            </div>
            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Employee</th>
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
                                    <td>
                                        <strong>{{ $payroll->employee->first_name }}
                                            {{ $payroll->employee->last_name }}</strong><br>
                                        <small class="text-muted">{{ $payroll->employee->designation }}</small>
                                    </td>
                                    <td>{{ $payroll->month_name }} {{ $payroll->year }}</td>
                                    <td>Tk. {{ number_format($payroll->gross_salary, 2) }}</td>
                                    <td>Tk. {{ number_format($payroll->total_deductions, 2) }}</td>
                                    <td>Tk. {{ number_format($payroll->bonuses, 2) }}</td>
                                    <td><strong>Tk. {{ number_format($payroll->net_salary, 2) }}</strong></td>
                                    <td>{{ \Carbon\Carbon::parse($payroll->generated_at)->format('M d, Y H:i') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.payroll.show', $payroll->payroll_id) }}"
                                                class="btn btn-info btn-sm" title="View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.payroll.download', $payroll->payroll_id) }}"
                                                class="btn btn-success btn-sm" title="Download Payslip">
                                                <i class="bi bi-download"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No payroll records found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    {{ $payrolls->links() }}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
