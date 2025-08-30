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
        tr,
        th {
            text-align: center;
        }
    </style>
</head>

<body>
    @include('admin.sidebar')
    {{-- <div class="main-container"> --}}
    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Employee List</h3>
            <div>
                <a href="{{ route('admin.create') }}" class="btn btn-primary">+ Add Employee</a>
                <button class="btn btn-outline-secondary">Invite</button>
            </div>
        </div>

        <!-- Search -->
        <div class="mb-3">
            <input type="text" class="form-control" placeholder="Search">
        </div>
        {{-- table --}}
        <div class="card shadow-sm">
            <div class="card-body">
                <!-- Responsive scroll wrapper -->
                <div class="table-responsive" style="overflow-x: auto; white-space: nowrap; max-width:100%;">
                    <table class="table table-bordered table-striped table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>DOB</th>
                                <th>Gender</th>
                                <th>Designation</th>
                                <th>Department</th>
                                <th>Joining Date</th>
                                <th>Employment Type</th>
                                {{-- <th>Salary Range</th>
                                <th>Bonus Eligibility</th> --}}
                                {{-- <th>Benefits</th> --}}
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Address</th>
                                {{-- <th>Emergency Contact Name</th>
                                <th>Emergency Contact Phone</th> --}}
                                <th>Resume</th>
                                <th>ID Proof</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $emp)
                                <tr>
                                    <td>{{$emp->employee_id}}</td>
                                    <td>
                                        @if ($emp->id_proof)
                                                <img src="{{ asset('storage/' . $emp->id_proof) }}"
                                                    alt="Employee ID Proof"
                                                    style="width: 30px; height: 30px; object-fit: cover;">
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $emp->first_name }} {{ $emp->last_name }}</td>
                                    <td>{{ $emp->dob }}</td>
                                    <td>{{ ucfirst($emp->gender) }}</td>
                                    <td>{{ $emp->designation }}</td>
                                    <td>{{ $emp->department ? $emp->department->department_name : 'N/A' }}</td>  
                                    <td>{{ $emp->date_joined }}</td>
                                    <td>{{ $emp->status }}</td>
                                    {{-- <td>{{ $emp->salary_range }}</td> --}}
                                    {{-- <td>{{ $emp->bonus_eligibility ? 'Yes' : 'No' }}</td> --}}
                                    {{-- <td>{{ $emp->benefits }}</td> --}}
                                    <td>{{ $emp->phone }}</td>
                                    <td>{{ $emp->email }}</td>
                                    <td>{{ $emp->address }}</td>
                                    {{-- <td>{{ $emp->emergency_contact_name }}</td> --}}
                                    {{-- <td>{{ $emp->emergency_contact_phone }}</td> --}}
                                    <td>
                                        @if ($emp->resume)
                                            <a href="{{ asset('storage/app/public/' . $emp->resume) }}"
                                                target="_blank">View</a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if ($emp->id_proof)
                                            <a href="{{ asset('storage/app/public/' . $emp->id_proof) }}"
                                                target="_blank">View</a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-between">
                    {{ $employees->links() }}
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
