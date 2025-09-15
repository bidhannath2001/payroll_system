<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Salary - Payroll System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
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
            justify-content: center;
            align-items: flex-start;
            padding: 40px 20px;
        }

        .card {
            width: 100%;
            max-width: 800px;
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
            padding: 1.25rem 1.5rem;
            font-weight: 600;
            font-size: 1.25rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .btn {
            border-radius: 8px;
        }

        .alert {
            border-radius: 8px;
        }

        @media (max-width: 576px) {
            .card-header {
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <div class="main-container">
        <div class="content-wrapper">
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Salary</h3>
                </div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                        </div>
                    @endif

                    <form action="{{ route('admin.salary.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="employee_id">Select Employee <span class="text-danger">*</span></label>
                                    <select name="employee_id" id="employee_id" class="form-control @error('employee_id') is-invalid @enderror" required>
                                        <option value="">Choose Employee</option>
                                        @foreach($employees as $employee)
                                            <option value="{{ $employee->employee_id }}" {{ old('employee_id') == $employee->employee_id ? 'selected' : '' }}>
                                                {{ $employee->first_name }} {{ $employee->last_name }} - {{ $employee->designation }} ({{ $employee->department->name ?? 'N/A' }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('employee_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="basic_salary">Basic Salary <span class="text-danger">*</span></label>
                                    <input type="number" name="basic_salary" id="basic_salary" 
                                           class="form-control @error('basic_salary') is-invalid @enderror" 
                                           value="{{ old('basic_salary') }}" step="0.01" min="0" required>
                                    @error('basic_salary')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="allowances">Allowances</label>
                                    <input type="number" name="allowances" id="allowances" 
                                           class="form-control @error('allowances') is-invalid @enderror" 
                                           value="{{ old('allowances', 0) }}" step="0.01" min="0">
                                    @error('allowances')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="deductions">Deductions</label>
                                    <input type="number" name="deductions" id="deductions" 
                                           class="form-control @error('deductions') is-invalid @enderror" 
                                           value="{{ old('deductions', 0) }}" step="0.01" min="0">
                                    @error('deductions')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tax_percentage">Tax Percentage</label>
                                    <input type="number" name="tax_percentage" id="tax_percentage" 
                                           class="form-control @error('tax_percentage') is-invalid @enderror" 
                                           value="{{ old('tax_percentage', 0) }}" step="0.01" min="0" max="100">
                                    @error('tax_percentage')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save Salary
                            </button>
                            <a href="{{ route('admin.salary.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to List
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>