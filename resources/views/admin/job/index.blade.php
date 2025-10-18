<!-- resources/views/admin/job/index.blade.php -->
<!doctype html>
<html lang="en">

<head>
    <title>Job List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        table th,
        table td {
            text-align: center;
            vertical-align: middle;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>

<body>
    @include('admin.sidebar')

    <div class="main-content">
        <h1 class="py 4">Job List</h1>
        <a href="{{ route('admin.job.create') }}" class="btn btn-primary mb-3">Create New Job</a>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Salary Range</th>
                    <th>Joining Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jobs as $job)
                <tr>
                    <td>{{ $job->job_id }}</td>
                    <td>{{ $job->job_title }}</td>
                    <td>{{ $job->description }}</td>
                    <td>{{ $job->salary_range }}</td>
                    <td>{{ $job->joining_date }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>