<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Payroll - Payroll System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f1f3f6;
        }

        .main-container {
            min-height: 100vh;
            display: flex;
        }

        /* Main content */
        .main-container > .card {
            flex: 1;
            height: 50vh;
            width: 50%;
            margin: 100px 400px;
            border: none;
            border-radius: 12px;
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: white;
            border-bottom: none;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-body {
            padding: 1.5rem;
        }

        .btn {
            border-radius: 8px;
        }

        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #ced4da;
        }

        .form-control:focus, .form-select:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .alert {
            border-radius: 8px;
        }

        @media (max-width: 768px) {
            .main-container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-container > .card {
                margin: 20px;
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="main-container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Generate Payroll</h3>
                <a href="{{ route('admin.payroll.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back to Payroll
                </a>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('admin.payroll.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="employee_id" class="form-label">Select Employee <span class="text-danger">*</span></label>
                            <select class="form-select @error('employee_id') is-invalid @enderror" id="employee_id" name="employee_id" required>
                                <option value="">Choose an employee...</option>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->employee_id }}" {{ old('employee_id') == $employee->employee_id ? 'selected' : '' }}>
                                        {{ $employee->first_name }} {{ $employee->last_name }} - {{ $employee->designation }}
                                    </option>
                                @endforeach
                            </select>
                            @error('employee_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="month" class="form-label">Month <span class="text-danger">*</span></label>
                            <select class="form-select @error('month') is-invalid @enderror" id="month" name="month" required>
                                <option value="">Select Month</option>
                                <option value="1" {{ old('month', now()->month) == '1' ? 'selected' : '' }}>January</option>
                                <option value="2" {{ old('month', now()->month) == '2' ? 'selected' : '' }}>February</option>
                                <option value="3" {{ old('month', now()->month) == '3' ? 'selected' : '' }}>March</option>
                                <option value="4" {{ old('month', now()->month) == '4' ? 'selected' : '' }}>April</option>
                                <option value="5" {{ old('month', now()->month) == '5' ? 'selected' : '' }}>May</option>
                                <option value="6" {{ old('month', now()->month) == '6' ? 'selected' : '' }}>June</option>
                                <option value="7" {{ old('month', now()->month) == '7' ? 'selected' : '' }}>July</option>
                                <option value="8" {{ old('month', now()->month) == '8' ? 'selected' : '' }}>August</option>
                                <option value="9" {{ old('month', now()->month) == '9' ? 'selected' : '' }}>September</option>
                                <option value="10" {{ old('month', now()->month) == '10' ? 'selected' : '' }}>October</option>
                                <option value="11" {{ old('month', now()->month) == '11' ? 'selected' : '' }}>November</option>
                                <option value="12" {{ old('month', now()->month) == '12' ? 'selected' : '' }}>December</option>
                            </select>
                            @error('month')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="year" class="form-label">Year <span class="text-danger">*</span></label>
                            <select class="form-select @error('year') is-invalid @enderror" id="year" name="year" required>
                                <option value="">Select Year</option>
                                @for($year = now()->year - 2; $year <= now()->year + 1; $year++)
                                    <option value="{{ $year }}" {{ old('year', now()->year) == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endfor
                            </select>
                            @error('year')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.payroll.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-lg"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-calculator"></i> Generate Payroll
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>