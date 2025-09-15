@extends('layouts.app')

<div class="container py-4">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="text-center mb-4">Create Job Position</h1>
    <form action="{{ route('jobs.store') }}" method="POST" enctype="multipart/form-data" id="jobForm">
        @csrf

        <div class="accordion" id="jobAccordion">
            <div class="card">
                <div class="card-header bg-primary text-white" id="headingBasic">
                    <h5 class="mb-0">
                        <button class="btn btn-link text-white" type="button" data-toggle="collapse" data-target="#collapseBasic" aria-expanded="true" aria-controls="collapseBasic">
                            Basic Information
                        </button>
                    </h5>
                </div>
                <div id="collapseBasic" class="collapse show" aria-labelledby="headingBasic" data-parent="#jobAccordion">
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
            </div>

            <div class="card">
                <div class="card-header bg-secondary text-white" id="headingJob">
                    <h5 class="mb-0">
                        <button class="btn btn-link text-white collapsed" type="button" data-toggle="collapse" data-target="#collapseJob" aria-expanded="false" aria-controls="collapseJob">
                            Job Details
                        </button>
                    </h5>
                </div>
                <div id="collapseJob" class="collapse" aria-labelledby="headingJob" data-parent="#jobAccordion">
                    <div class="card-body row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Designation/Title *</label>
                            <input type="text" name="designation" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Department *</label>
                            <select name="department_id" class="form-select" required>
                                <option value="">-- Select Department --</option>
                                @foreach ($departments as $dept)
                                    <option value="{{ $dept->department_id }}">{{ $dept->department_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Role *</label>
                            <select name="role_id" class="form-select" required>
                                <option value="">-- Select Role --</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->role_id }}">{{ $role->role_name }}</option>
                                @endforeach
                            </select>
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
                        <div class="col-md-6">
                            <label class="form-label">Salary Range *</label>
                            <input type="text" name="salary_range" placeholder="e.g. $2000 - $3000" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-warning" id="headingContact">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseContact" aria-expanded="false" aria-controls="collapseContact">
                            Contact & Emergency Info
                        </button>
                    </h5>
                </div>
                <div id="collapseContact" class="collapse" aria-labelledby="headingContact" data-parent="#jobAccordion">
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
            </div>

            <div class="card">
                <div class="card-header bg-info text-white" id="headingDocuments">
                    <h5 class="mb-0">
                        <button class="btn btn-link text-white collapsed" type="button" data-toggle="collapse" data-target="#collapseDocuments" aria-expanded="false" aria-controls="collapseDocuments">
                            Documents
                        </button>
                    </h5>
                </div>
                <div id="collapseDocuments" class="collapse" aria-labelledby="headingDocuments" data-parent="#jobAccordion">
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
            </div>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-lg btn-primary">Save Job Position</button>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>