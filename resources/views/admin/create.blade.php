<!doctype html>
<html lang="en">

<head>
    <title>Create Employee</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container py-4">

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="text-center mb-4">Employee Information Form</h1>
        <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data" id="employeeForm">
            @csrf

            <!-- Basic Information -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">Basic Information</div>
                <div class="card-body row g-3">
                    <div class="col-md-6">
                        <label class="form-label">First Name *</label>
                        <input type="text" name="first_name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Last Name *</label>
                        <input type="text" name="last_name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Date of Birth *</label>
                        <input type="date" name="dob" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Gender *</label>
                        <select name="gender" class="form-control" required>
                            <option value="">-- Select --</option>
                            <option>Male</option>
                            <option>Female</option>
                            <option>Other</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Job Details -->
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">Job Details</div>
                <div class="card-body row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Designation *</label>
                        <input type="text" name="designation" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Department *</label>
                        <select name="department_id" class="form-control" required>
                            <option value="">-- Select Department --</option>
                            @foreach ($departments as $dept)
                                <option value="{{ $dept->department_id }}">{{ $dept->department_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Role *</label>
                        <select name="role_id" class="form-control" required>
                            <option value="">-- Select Role --</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->role_id }}">{{ $role->role_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Date Joined *</label>
                        <input type="date" name="date_joined" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Employment Status *</label>
                        <select name="status" class="form-control" required>
                            <option value="">-- Select Status --</option>
                            <option value="full time">Full-Time</option>
                            <option value="part time">Part-Time</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="card mb-4">
                <div class="card-header bg-warning">Contact Information</div>
                <div class="card-body row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Phone *</label>
                        <input type="tel" name="phone" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email *</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Address *</label>
                        <textarea name="address" class="form-control" rows="2" required></textarea>
                    </div>
                </div>
            </div>

            <!-- Documents -->
            <div class="card mb-4">
                <div class="card-header bg-info text-white">Documents</div>
                <div class="card-body row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Upload Resume</label>
                        <input type="file" name="resume" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Upload ID Proof</label>
                        <input type="file" name="id_proof" class="form-control">
                    </div>
                </div>
            </div>
            <!-- Submit -->
            <div class="text-center">
                <button type="submit" class="btn btn-lg btn-primary">Save Employee</button>
            </div>
        </form>
    </div>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
