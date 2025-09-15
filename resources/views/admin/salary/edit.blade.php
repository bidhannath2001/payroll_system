<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Salary - Payroll System</title>
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
                    <h3 class="card-title">Edit Salary - {{ $salary->employee->first_name }} {{ $salary->employee->last_name }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.salary.update', $salary->salary_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="employee_id">Employee</label>
                                    <input type="text" class="form-control" 
                                           value="{{ $salary->employee->first_name }} {{ $salary->employee->last_name }} - {{ $salary->employee->designation }}" 
                                           readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="basic_salary">Basic Salary <span class="text-danger">*</span></label>
                                    <input type="number" name="basic_salary" id="basic_salary" 
                                           class="form-control @error('basic_salary') is-invalid @enderror" 
                                           value="{{ old('basic_salary', $salary->basic_salary) }}" step="0.01" min="0" required>
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
                                           value="{{ old('allowances', $salary->allowances) }}" step="0.01" min="0">
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
                                           value="{{ old('deductions', $salary->deductions) }}" step="0.01" min="0">
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
                                           value="{{ old('tax_percentage', $salary->tax_percentage) }}" step="0.01" min="0" max="100">
                                    @error('tax_percentage')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Salary
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



