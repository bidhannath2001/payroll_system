@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Job Desk Hub</h1>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createJobModal">Add New Job</button>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table id="jobsTable" class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Designation</th>
                    <th>Department</th>
                    <th>Salary Range</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jobs as $job)
                    <tr>
                        <td>{{ $job->designation ?? 'N/A' }}</td>
                        <td>{{ optional($job->department)->department_name ?? $job->department_id ?? 'N/A' }}</td>
                        <td>{{ $job->salary_range ?? 'N/A' }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm edit-btn" data-id="{{ $job->id }}" data-bs-toggle="modal" data-bs-target="#editJobModal">Edit</button>
                            <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" style="display:inline;"
                                  onsubmit="return confirm('Are you sure you want to delete this job?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No jobs available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Create Job Modal -->
    <div class="modal fade" id="createJobModal" tabindex="-1" aria-labelledby="createJobModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createJobModalLabel">Add New Job</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('jobs.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="designation" class="form-label">Designation</label>
                            <input type="text" class="form-control" id="designation" name="designation" required>
                        </div>
                        <div class="mb-3">
                            <label for="department_id" class="form-label">Department</label>
                            <select class="form-control" id="department_id" name="department_id" required>
                                @foreach(\App\Models\Department::all() as $dept)
                                    <option value="{{ $dept->department_id }}">{{ $dept->department_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="salary_range" class="form-label">Salary Range</label>
                            <input type="text" class="form-control" id="salary_range" name="salary_range" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Job Modal -->
    <div class="modal fade" id="editJobModal" tabindex="-1" aria-labelledby="editJobModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editJobModalLabel">Edit Job</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="editForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editId" name="id">
                        <div class="mb-3">
                            <label for="editDesignation" class="form-label">Designation</label>
                            <input type="text" class="form-control" id="editDesignation" name="designation" required>
                        </div>
                        <div class="mb-3">
                            <label for="editDepartmentId" class="form-label">Department</label>
                            <select class="form-control" id="editDepartmentId" name="department_id" required>
                                @foreach(\App\Models\Department::all() as $dept)
                                    <option value="{{ $dept->department_id }}">{{ $dept->department_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editSalaryRange" class="form-label">Salary Range</label>
                            <input type="text" class="form-control" id="editSalaryRange" name="salary_range" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#jobsTable').DataTable({
                "pageLength": 10,
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "order": [[0, 'asc']] // Default sort by designation
            });

            // Populate edit modal with job data
            $('.edit-btn').on('click', function() {
                var jobId = $(this).data('id');
                $.get(`/admin/jobs/${jobId}/edit`, function(data) {
                    $('#editId').val(data.id);
                    $('#editDesignation').val(data.designation);
                    $('#editDepartmentId').val(data.department_id);
                    $('#editSalaryRange').val(data.salary_range);
                    $('#editForm').attr('action', `/admin/jobs/${data.id}`);
                    $('#editJobModal').modal('show');
                });
            });
        });
    </script>
@endsection