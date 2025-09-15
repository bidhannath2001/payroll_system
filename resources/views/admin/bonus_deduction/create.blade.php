<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Bonus/Deduction - Payroll System</title>
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
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* full viewport height */
            padding: 20px;
        }

        .card {
            border: none;
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 700px;
            border-radius: 12px;
        }

        .card-header {
            background-color: #007bff;
            color: white;
            border-bottom: none;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            padding: 1.25rem 1.5rem;
        }

        .card-title {
            margin: 0;
            font-weight: 600;
        }

        .card-body {
            padding: 1.5rem;
        }

        .form-group label {
            font-weight: 500;
        }

        .form-control {
            border-radius: 8px;
        }

        .btn {
            min-width: 120px;
            border-radius: 8px;
        }

        @media (max-width: 576px) {
            .card-body {
                padding: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="main-container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add Bonus/Deduction</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.bonus_deduction.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="employee_id">Select Employee <span class="text-danger">*</span></label>
                        <select name="employee_id" id="employee_id" class="form-select @error('employee_id') is-invalid @enderror" required>
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

                    <div class="mb-3">
                        <label for="type">Type <span class="text-danger">*</span></label>
                        <select name="type" id="type" class="form-select @error('type') is-invalid @enderror" required>
                            <option value="">Select Type</option>
                            <option value="Bonus" {{ old('type') == 'Bonus' ? 'selected' : '' }}>Bonus</option>
                            <option value="Deduction" {{ old('type') == 'Deduction' ? 'selected' : '' }}>Deduction</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="amount">Amount <span class="text-danger">*</span></label>
                        <input type="number" name="amount" id="amount" 
                               class="form-control @error('amount') is-invalid @enderror" 
                               value="{{ old('amount') }}" step="0.01" min="0" required>
                        @error('amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="date">Date <span class="text-danger">*</span></label>
                        <input type="date" name="date" id="date" 
                               class="form-control @error('date') is-invalid @enderror" 
                               value="{{ old('date', date('Y-m-d')) }}" required>
                        @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="reason">Reason</label>
                        <textarea name="reason" id="reason" rows="3" 
                                  class="form-control @error('reason') is-invalid @enderror" 
                                  placeholder="Enter reason for bonus or deduction">{{ old('reason') }}</textarea>
                        @error('reason')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Save Record
                        </button>
                        <a href="{{ route('admin.bonus_deduction.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Back to List
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



