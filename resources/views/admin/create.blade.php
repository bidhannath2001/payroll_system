<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    @if ($errors->any())
        <div class="container py-4">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
    @endif
    @if (session('success'))
        <div class="container py-4">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
    @endif
    <div class="container py-4">
        <h1 class="text-center mb-4">Employee Information Form</h1>
        <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data" id="employeeForm">
            @csrf
            <!-- SECTION 1: Basic Information -->
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
                        <select name="gender" class="form-select" required>
                            <option value="">-- Select --</option>
                            <option>Male</option>
                            <option>Female</option>
                            <option>Other</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- SECTION 2: Job Details -->
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">Job Details</div>
                <div class="card-body row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Designation *</label>
                        <input type="text" name="designation" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Department *</label>
                        <input type="text" name="department" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Joining Date *</label>
                        <input type="date" name="joining_date" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Employment Type *</label>
                        <select name="employment_type" class="form-select" required>
                            <option value="">-- Select --</option>
                            <option>Full-Time</option>
                            <option>Part-Time</option>
                            <option>Contract</option>
                            <option>Intern</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- SECTION 3: Salary & Benefits -->
            <div class="card mb-4">
                <div class="card-header bg-success text-white">Salary & Benefits</div>
                <div class="card-body row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Salary Range *</label>
                        <input type="text" name="salary_range" placeholder="e.g. $2000 - $3000" class="form-control"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Bonus Eligibility</label>
                        <select name="bonus_eligibility" class="form-select">
                            <option>No</option>
                            <option>Yes</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Benefits</label>
                        <textarea name="benefits" class="form-control" rows="2"
                            placeholder="List benefits like health insurance, PF, etc."></textarea>
                    </div>
                </div>
            </div>

            <!-- SECTION 4: Contact & Emergency Info -->
            <div class="card mb-4">
                <div class="card-header bg-warning">Contact & Emergency Info</div>
                <div class="card-body row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Phone *</label>
                        <input type="tel" name="phone" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email *</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email *</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Password *</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Address *</label>
                        <textarea name="address" class="form-control" rows="2" required></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Emergency Contact Name *</label>
                        <input type="text" name="emergency_contact_name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Emergency Contact Phone *</label>
                        <input type="tel" name="emergency_contact_phone" class="form-control" required>
                    </div>
                </div>
            </div>

            <!-- SECTION 5: Documents -->
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
        </div>
        <!-- Optional JavaScript Alert -->
        <script>
            document.getElementById('employeeForm').addEventListener('submit', function(e) {
                alert('Employee data submitted successfully!');
            });
        </script>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
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
