<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll Management - Payroll System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
 <style>
        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f1f3f6;
        }

        .main-container {
            min-height: 100vh;
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            background: #474751ff;
            color: #ffffff54;
            position: sticky;
            top: 0;
            left: 0;
            overflow-y: auto;
            flex-shrink: 0;
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }
        .sidebar::-webkit-scrollbar-thumb {
            background-color: #f2f4f5ff;
            border-radius: 3px;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 14px 20px;
            transition: background 0.2s ease;
        }
        .sidebar a:hover {
            background: #fcfdfeff;
        }

        /* Main content */
        .main-container > .card {
            flex: 1;
            margin: 40px 20px;
            border: none;
            border-radius: 12px;
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: white;
            border-bottom: none;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-body {
            padding: 1.5rem;
        }

        .btn {
            border-radius: 8px;
        }

        .table th {
            background-color: #e9ecef;
            font-weight: 500;
        }

        .badge-success {
            background-color: #28a745;
        }

        .badge-danger {
            background-color: #dc3545;
        }

        .alert {
            border-radius: 8px;
        }

        @media (max-width: 768px) {
            .main-container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-container > .card {
                margin: 20px;
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="main-container">
        @include('admin.sidebar')
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Payroll Management</h3>
                <a href="{{ route('admin.payroll.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i> Generate Payroll
                </a>
            </div>
            <div class="card-body">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
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
                                        <strong>{{ $payroll->employee->first_name }} {{ $payroll->employee->last_name }}</strong><br>
                                        <small class="text-muted">{{ $payroll->employee->designation }}</small>
                                    </td>
                                    <td>{{ $payroll->month_name }} {{ $payroll->year }}</td>
                                    <td>${{ number_format($payroll->gross_salary, 2) }}</td>
                                    <td>${{ number_format($payroll->total_deductions, 2) }}</td>
                                    <td>${{ number_format($payroll->bonuses, 2) }}</td>
                                    <td><strong>${{ number_format($payroll->net_salary, 2) }}</strong></td>
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
 