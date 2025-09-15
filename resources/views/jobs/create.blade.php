<!doctype html>
<html lang="en">
<head>
    <title>Create Job Position</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body>
    <div class="container py-4">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
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

        <form action="{{ route('jobs.store') }}" method="POST" id="jobCreateForm">
            @csrf
            <div class="card shadow-lg border-0 rounded-3 mx-auto" style="max-width: 800px;">
                <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between fs-5 fw-bold">
                    <a href="{{ route('jobs.index') }}" class="text-white text-decoration-none"
                       data-toggle="tooltip" data-placement="bottom" title="Back to Jobs">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                    <span>Create New Job Position</span>
                    <span></span>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <label for="title" class="form-label font-weight-bold">Job Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                               id="title" name="title" value="{{ old('title') }}"
                               placeholder="Enter job title" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="department" class="form-label font-weight-bold">Department <span class="text-danger">*</span></label>
                        <select class="form-control @error('department') is-invalid @enderror"
                                id="department" name="department" required>
                            <option value="">Select Department</option>
                            <option value="IT" {{ old('department') == 'IT' ? 'selected' : '' }}>IT</option>
                            <option value="HR" {{ old('department') == 'HR' ? 'selected' : '' }}>HR</option>
                            <option value="Finance" {{ old('department') == 'Finance' ? 'selected' : '' }}>Finance</option>
                            <option value="Marketing" {{ old('department') == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                            <option value="Operations" {{ old('department') == 'Operations' ? 'selected' : '' }}>Operations</option>
                            <option value="Sales" {{ old('department') == 'Sales' ? 'selected' : '' }}>Sales</option>
                        </select>
                        @error('department')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="salary" class="form-label font-weight-bold">Salary <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" class="form-control @error('salary') is-invalid @enderror"
                                   id="salary" name="salary" value="{{ old('salary') }}"
                                   placeholder="Enter salary amount" min="0" required>
                            @error('salary')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <small class="form-text text-muted">Enter annual salary amount</small>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label font-weight-bold">Job Description <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description" name="description" rows="5"
                                  placeholder="Enter detailed job description, responsibilities, and requirements" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg mr-2">
                            <i class="bi bi-check-circle"></i> Create Job Position
                        </button>
                        <a href="{{ route('jobs.index') }}" class="btn btn-secondary btn-lg">
                            <i class="bi bi-x-circle"></i> Cancel
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>