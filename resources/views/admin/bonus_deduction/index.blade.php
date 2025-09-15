<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bonus & Deduction Management - Payroll System</title>

    <!-- Bootstrap + Icons + Google Font -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
    <style>
        th,
        td {
            text-align: center;
        }
    </style>
<body>
    @include('admin.sidebar')
    {{-- </div> --}}
    <div class="main-content">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Bonus & Deduction Management</h3>
                <a href="{{ route('admin.bonus_deduction.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i> Add Record
                </a>
            </div>

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Reason</th>
                                <th>Date</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bonusDeductions as $record)
                                <tr>
                                    <td>
                                        <strong>{{ $record->employee->first_name }}
                                            {{ $record->employee->last_name }}</strong><br>
                                        <small class="text-muted">{{ $record->employee->designation }}</small>
                                    </td>
                                    <td>
                                        @if ($record->type == 'Bonus')
                                            <span class="badge badge-success">{{ $record->type }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ $record->type }}</span>
                                        @endif
                                    </td>
                                    <td>Tk. {{ number_format($record->amount, 2) }}</td>
                                    <td>{{ $record->reason ?? 'N/A' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($record->date)->format('M d, Y') }}</td>
                                    <td>{{ $record->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.bonus_deduction.edit', $record->id) }}"
                                                class="btn btn-warning btn-sm" title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('admin.bonus_deduction.destroy', $record->id) }}"
                                                method="POST" style="display: inline-block;"
                                                onsubmit="return confirm('Are you sure you want to delete this record?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No records found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    {{ $bonusDeductions->links() }}
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
