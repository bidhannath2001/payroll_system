<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payslip - {{ $payroll->employee->first_name }} {{ $payroll->employee->last_name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .payslip-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #007bff;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .company-name {
            font-size: 28px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 10px;
        }
        .payslip-title {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }
        .period {
            font-size: 16px;
            color: #666;
        }
        .employee-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .info-section {
            flex: 1;
        }
        .info-section h4 {
            color: #007bff;
            margin-bottom: 15px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
        }
        .info-row {
            display: flex;
            margin-bottom: 8px;
        }
        .info-label {
            font-weight: bold;
            width: 120px;
            color: #555;
        }
        .info-value {
            flex: 1;
            color: #333;
        }
        .salary-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .salary-table th,
        .salary-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .salary-table th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }
        .salary-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .total-row {
            background-color: #e9ecef !important;
            font-weight: bold;
            font-size: 16px;
        }
        .net-salary-row {
            background-color: #d4edda !important;
            font-weight: bold;
            font-size: 18px;
            color: #155724;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #007bff;
            color: #666;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        @media print {
            body {
                margin: 0;
                padding: 0;
                background: white;
            }
            .payslip-container {
                box-shadow: none;
                margin: 0;
                padding: 20px;
            }
            .btn {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="payslip-container">
        <div class="header">
            <div class="company-name">Payroll Management System</div>
            <div class="payslip-title">PAYSLIP</div>
            <div class="period">{{ $payroll->month_name }} {{ $payroll->year }}</div>
        </div>

        <div class="employee-info">
            <div class="info-section">
                <h4>Employee Details</h4>
                <div class="info-row">
                    <div class="info-label">Name:</div>
                    <div class="info-value">{{ $payroll->employee->first_name }} {{ $payroll->employee->last_name }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Designation:</div>
                    <div class="info-value">{{ $payroll->employee->designation }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Department:</div>
                    <div class="info-value">{{ $payroll->employee->department->name ?? 'N/A' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Email:</div>
                    <div class="info-value">{{ $payroll->employee->email }}</div>
                </div>
            </div>
            <div class="info-section">
                <h4>Payroll Details</h4>
                <div class="info-row">
                    <div class="info-label">Pay Period:</div>
                    <div class="info-value">{{ $payroll->month_name }} {{ $payroll->year }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Generated:</div>
                    <div class="info-value">{{ \Carbon\Carbon::parse($payroll->generated_at)->format('M d, Y') }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Payroll ID:</div>
                    <div class="info-value">#{{ $payroll->payroll_id }}</div>
                </div>
            </div>
        </div>

        <table class="salary-table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th class="text-right">Amount (Tk.)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Basic Salary</td>
                    <td class="text-right">Tk. {{ number_format($salary->basic_salary ?? 0, 2) }}</td>
                </tr>
                <tr>
                    <td>Allowances</td>
                    <td class="text-right">Tk.{{ number_format($salary->allowances ?? 0, 2) }}</td>
                </tr>
                <tr>
                    <td>Gross Salary</td>
                    <td class="text-right">Tk. {{ number_format($payroll->gross_salary, 2) }}</td>
                </tr>
                <tr>
                    <td>Bonuses</td>
                    <td class="text-right">Tk. {{ number_format($payroll->bonuses, 2) }}</td>
                </tr>
                <tr class="total-row">
                    <td><strong>Total Earnings</strong></td>
                    <td class="text-right"><strong>Tk. {{ number_format($payroll->gross_salary + $payroll->bonuses, 2) }}</strong></td>
                </tr>
                <tr>
                    <td>Total Deductions</td>
                    <td class="text-right">Tk. {{ number_format($payroll->total_deductions, 2) }}</td>
                </tr>
                <tr class="net-salary-row">
                    <td><strong>NET SALARY</strong></td>
                    <td class="text-right"><strong>Tk. {{ number_format($payroll->net_salary, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <p><strong>This is a computer-generated payslip and does not require a signature.</strong></p>
            <p>Generated on {{ now()->format('M d, Y H:i:s') }}</p>
            <button onclick="window.print()" class="btn btn-primary">Print Payslip</button>
        </div>
    </div>
</body>
</html>
