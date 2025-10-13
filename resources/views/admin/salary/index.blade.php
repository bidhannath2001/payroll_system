<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary Management - Payroll System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        table th, table td { text-align: center; vertical-align: middle; }
        .main-content { margin-left: 250px; padding: 20px; } 
    
    </style>
</head>

<body>
    @include('admin.sidebar')
    <div class="main-content">
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title">Salary Management</h3>
                                <a href="{{ route('admin.salary.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus"></i> Add Salary
                                </a>
                            </div>
                            <div class="card-body">
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                @endif

                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Employee</th>
                                                <th>Basic Salary</th>
                                                <th>Allowances</th>
                                                <th>Deductions</th>
                                                <th>Tax %</th>
                                                <th>Created At</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($salaries as $salary)
                                                <tr>
                                                    <td>
                                                        <strong>{{ $salary->employee->first_name }}
                                                            {{ $salary->employee->last_name }}</strong><br>
                                                        <small
                                                            class="text-muted">{{ $salary->employee->designation }}</small>
                                                    </td>
                                                    <td>Tk. {{ number_format($salary->basic_salary, 2) }}</td>
                                                    <td>Tk. {{ number_format($salary->allowances, 2) }}</td>
                                                    <td>Tk. {{ number_format($salary->deductions, 2) }}</td>
                                                    <td> {{ $salary->tax_percentage }}%</td>
                                                    <td>{{ $salary->created_at->format('M d, Y') }}</td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="{{ route('admin.salary.edit', $salary->salary_id) }}"
                                                                class="btn btn-warning btn-sm" title="Edit">
                                                                <i class="bi bi-pencil-square"></i>
                                                            </a>
                                                            <form
                                                                action="{{ route('admin.salary.destroy', $salary->salary_id) }}"
                                                                method="POST" style="display: inline-block;"
                                                                onsubmit="return confirm('Are you sure you want to delete this salary record?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    title="Delete">
                                                                    <i class="bi bi-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">No salary records found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div class="d-flex justify-content-center">
                                    {{ $salaries->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
