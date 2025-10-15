<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Requests</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
        <div class="d-flex justify-content-between align-items-center mb-3">
            {{-- <h2 class="mb-4 text-center text-dark">Leave Requests Management</h2> --}}
            <h3 class="py-4">Leave Requests Management</h3>
            {{-- <h3>Employee List</h3> --}}
        </div>



        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="container mt-4">

    <!-- Navigation Tabs -->
    <ul class="nav nav-tabs mb-4" id="leaveTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending"
                type="button" role="tab">Pending Requests</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="approved-tab" data-bs-toggle="tab" data-bs-target="#approved"
                type="button" role="tab">Approved Requests</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="rejected-tab" data-bs-toggle="tab" data-bs-target="#rejected"
                type="button" role="tab">Rejected Requests</button>
        </li>
    </ul>

    <!-- Tab Contents -->
    <div class="tab-content" id="leaveTabsContent">

        <!-- Pending Requests -->
        <div class="tab-pane fade show active" id="pending" role="tabpanel">
            <h4 class="text-warning mb-3">Pending Requests</h4>
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover text-center align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Employee</th>
                                    <th>Leave Type</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Reason</th>
                                    <th>Available Leaves</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pendingRequests as $leave)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $leave->employee->first_name }}</td>
                                        <td>{{ $leave->leave_type }}</td>
                                        <td>{{ \Carbon\Carbon::parse($leave->start_date)->format('d M Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($leave->end_date)->format('d M Y') }}</td>
                                        <td>{{ $leave->reason }}</td>
                                        <td>{{ $leave->employee->available_leave }}</td>
                                        <td>
                                            <form action="{{ route('admin.leave_requests.status', $leave->leave_request_id) }}"
                                                  method="POST" class="d-flex gap-1 justify-content-center">
                                                @csrf
                                                <button type="submit" name="status" value="approved"
                                                    class="btn btn-outline-success btn-sm" title="Approve">
                                                    <i class="bi bi-check-circle"></i>
                                                </button>
                                                <button type="submit" name="status" value="rejected"
                                                    class="btn btn-outline-danger btn-sm" title="Reject">
                                                    <i class="bi bi-x-circle"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">No pending requests.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Approved Requests -->
        <div class="tab-pane fade" id="approved" role="tabpanel">
            <h4 class="text-success mb-3">Approved Requests</h4>
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover text-center align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Employee</th>
                                    <th>Leave Type</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Reason</th>
                                    <th>Available Leaves</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($approvedRequests as $leave)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $leave->employee->first_name }}</td>
                                        <td>{{ $leave->leave_type }}</td>
                                        <td>{{ \Carbon\Carbon::parse($leave->start_date)->format('d M Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($leave->end_date)->format('d M Y') }}</td>
                                        <td>{{ $leave->reason }}</td>
                                        <td>{{ $leave->employee->available_leave }}</td>
                                        <td><span class="badge bg-success"><i class="fas fa-check"></i> Approved</span></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">No approved requests.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rejected Requests -->
        <div class="tab-pane fade" id="rejected" role="tabpanel">
            <h4 class="text-danger mb-3">Rejected Requests</h4>
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover text-center align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Employee</th>
                                    <th>Leave Type</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Reason</th>
                                    <th>Available Leaves</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rejectedRequests as $leave)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $leave->employee->first_name }}</td>
                                        <td>{{ $leave->leave_type }}</td>
                                        <td>{{ \Carbon\Carbon::parse($leave->start_date)->format('d M Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($leave->end_date)->format('d M Y') }}</td>
                                        <td>{{ $leave->reason }}</td>
                                        <td>{{ $leave->employee->available_leave }}</td>
                                        <td><span class="badge bg-danger"><i class="fas fa-times"></i> Rejected</span></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">No rejected requests.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

    <style>
        tr,
        th {
            text-align: center;
        }

        .table-hover tbody tr:hover {
            background: #f1f5f9;
            /* transform: scale(1.01);
            transition: all 0.2s ease-in-out; */
        }

        /* .btn i {
            font-size: 1rem;
        } */
    </style>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
