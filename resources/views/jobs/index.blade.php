<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <style>
        tr, th {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Job Desk</h3>
            <a href="{{ route('jobs.create') }}" class="btn btn-primary">Create New Job</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive" style="overflow-x: auto; white-space: nowrap; max-width:100%;">
                    <table class="table table-bordered table-striped table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Salary</th>
                                <th>Department</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jobs as $job)
                            <tr>
                                <td>{{ $job->id }}</td>
                                <td>{{ $job->title }}</td>
                                <td>{{ $job->description }}</td>
                                <td>${{ number_format($job->salary) }}</td>
                                <td>{{ $job->department }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-muted">No jobs found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>