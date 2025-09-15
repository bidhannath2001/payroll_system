<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payslip - {{ $payroll->employee->first_name }} {{ $payroll->employee->last_name }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            background: white;
        }
        .payslip-container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 15px;
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .company-name {
            font-size: 20px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 5px;
        }
        .payslip-title {
            font-size: 18px;
            color: #333;
            margin-bottom: 5px;
        }
        .period {
            font-size: 14px;
            color: #666;
        }
        .main-content {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }
        .left-section {
            flex: 1;
        }
        .right-section {
            flex: 1;
        }
        .info-section {
            margin-bottom: 10px;
        }
        .info-section h4 {
            color: #007bff;
            font-size: 14px;
            margin-bottom: 8px;
            border-bottom: 1px solid #007bff;
            padding-bottom: 3px;
        }
        .info-row {
            display: flex;
            margin-bottom: 4px;
            font-size: 11px;
        }
        .info-label {
            font-weight: bold;
            width: 80px;
            color: #555;
            white-space: nowrap;
        }
        .info-value {
            flex: 1;
            color: #333;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .salary-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            font-size: 11px;
        }
        .salary-table th,
        .salary-table td {
            padding: 6px 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        .salary-table th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            font-size: 10px;
        }
        .salary-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .total-row {
            background-color: #e9ecef !important;
            font-weight: bold;
        }
        .net-salary-row {
            background-color: #d4edda !important;
            font-weight: bold;
            font-size: 12px;
            color: #155724;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .footer {
            text-align: center;
            margin-top: 15px;
            padding-top: 10px;
            border-top: 2px solid #007bff;
            color: #666;
            font-size: 10px;
        }
        .compact-table {
            font-size: 10px;
        }
        .compact-table th,
        .compact-table td {
            padding: 4px 6px;
        }
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            .payslip-container {
                padding: 10px;
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

        <div class="main-content">
            <div class="left-section">
                <div class="info-section">
                    <h4>Employee Details</h4>
                    <div class="info-row">
                        <div class="info-label">Name: {{ $payroll->employee->first_name . ' ' . $payroll->employee->last_name }}</div>
                        <!-- <div class="info-value">{{ $payroll->employee->first_name . ' ' . $payroll->employee->last_name }}</div> -->
                    </div>
                    <div class="info-row">
                        <div class="info-label">Designation: {{ $payroll->employee->designation }}</div>
                        <!-- <div class="info-value">{{ $payroll->employee->designation }}</div> -->
                    </div>
                    <div class="info-row">
                        <div class="info-label">Email: {{ $payroll->employee->email }}</div>
                        <!-- <div class="info-value">{{ $payroll->employee->email }}</div> -->
                    </div>
                </div>
                
                <div class="info-section">
                    <h4>Attendance Summary</h4>
                    <div class="info-row">
                        <div class="info-label">Present Days: {{ $presentDays ?? 0 }}</div>
                        <!-- <div class="info-value">{{ $presentDays ?? 0 }}</div> -->
                    </div>
                    <div class="info-row">
                        <div class="info-label">Absent Days: {{ $absentDays ?? 0 }}</div>
                        <!-- <div class="info-value">{{ $absentDays ?? 0 }}</div> -->
                    </div>
                    <div class="info-row">
                        <div class="info-label">Total Days: {{ $totalDays ?? 0 }}</div>
                        <!-- <div class="info-value">{{ $totalDays ?? 0 }}</div> -->
                    </div>
                </div>
            </div>
            
            <div class="right-section">
                <div class="info-section">
                    <h4>Payroll Details</h4>
                    <div class="info-row">
                        <div class="info-label">Pay Period: {{ $payroll->month_name }} {{ $payroll->year }}</div>
                        <!-- <div class="info-value">{{ $payroll->month_name }} {{ $payroll->year }}</div> -->
                    </div>
                    <div class="info-row">
                        <div class="info-label">Generated: {{ \Carbon\Carbon::parse($payroll->generated_at)->format('M d, Y') }}</div>
                        <!-- <div class="info-value">{{ \Carbon\Carbon::parse($payroll->generated_at)->format('M d, Y') }}</div> -->
                    </div>
                    <div class="info-row">
                        <div class="info-label">Payroll ID: #{{ $payroll->payroll_id }}</div>
                        <!-- <div class="info-value">#{{ $payroll->payroll_id }}</div> -->
                    </div>
                </div>
                
                <div class="info-section">
                    <h4>Base Salary Info</h4>
                    <div class="info-row">
                        <div class="info-label">Basic Salary: Tk. {{ number_format($salary->basic_salary ?? 0, 2) }}</div>
                        <!-- <div class="info-value">${{ number_format($salary->basic_salary ?? 0, 2) }}</div> -->
                    </div>
                    <div class="info-row">
                        <div class="info-label">Allowances: Tk. {{ number_format($salary->allowances ?? 0, 2) }}</div>
                        <!-- <div class="info-value">${{ number_format($salary->allowances ?? 0, 2) }}</div> -->
                    </div>
                    <div class="info-row">
                        <div class="info-label">Tax Rate: {{ $salary->tax_percentage ?? 0 }}%</div>
                        <!-- <div class="info-value">{{ $salary->tax_percentage ?? 0 }}%</div> -->
                    </div>
                </div>
            </div>
        </div>

        <table class="salary-table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th class="text-right">Amount ($)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Basic Salary</td>
                    <td class="text-right">{{ number_format($salary->basic_salary ?? 0, 2) }}</td>
                </tr>
                <tr>
                    <td>Allowances</td>
                    <td class="text-right">{{ number_format($salary->allowances ?? 0, 2) }}</td>
                </tr>
                <tr>
                    <td>Gross Salary</td>
                    <td class="text-right">{{ number_format($payroll->gross_salary, 2) }}</td>
                </tr>
                <tr>
                    <td>Bonuses</td>
                    <td class="text-right">{{ number_format($payroll->bonuses, 2) }}</td>
                </tr>
                <tr class="total-row">
                    <td><strong>Total Earnings</strong></td>
                    <td class="text-right"><strong>{{ number_format($payroll->gross_salary + $payroll->bonuses, 2) }}</strong></td>
                </tr>
                <tr>
                    <td>Base Deductions</td>
                    <td class="text-right">-{{ number_format($salary->deductions ?? 0, 2) }}</td>
                </tr>
                <tr>
                    <td>Tax Deductions</td>
                    <td class="text-right">-{{ number_format(($payroll->gross_salary * ($salary->tax_percentage ?? 0)) / 100, 2) }}</td>
                </tr>
                <tr>
                    <td>Other Deductions</td>
                    <td class="text-right">-{{ number_format(($payroll->total_deductions ?? 0) - ($salary->deductions ?? 0) - (($payroll->gross_salary * ($salary->tax_percentage ?? 0)) / 100), 2) }}</td>
                </tr>
                <tr class="total-row">
                    <td><strong>Total Deductions</strong></td>
                    <td class="text-right"><strong>-{{ number_format($payroll->total_deductions, 2) }}</strong></td>
                </tr>
                <tr class="net-salary-row">
                    <td><strong>NET SALARY</strong></td>
                    <td class="text-right"><strong>Tk. {{ number_format($payroll->net_salary, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>

        @if(isset($bonusDetails) && $bonusDetails->count() > 0)
        <div class="info-section">
            <h4>Bonus Details</h4>
            <table class="salary-table compact-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Reason</th>
                        <th class="text-right">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bonusDetails as $bonus)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($bonus->date)->format('M d, Y') }}</td>
                        <td>{{ $bonus->reason ?? 'N/A' }}</td>
                        <td class="text-right">Tk. {{ number_format($bonus->amount, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        @if(isset($deductionDetails) && $deductionDetails->count() > 0)
        <div class="info-section">
            <h4>Deduction Details</h4>
            <table class="salary-table compact-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Reason</th>
                        <th class="text-right">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($deductionDetails as $deduction)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($deduction->date)->format('M d, Y') }}</td>
                        <td>{{ $deduction->reason ?? 'N/A' }}</td>
                        <td class="text-right">Tk. {{ number_format($deduction->amount, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        <div class="footer">
            <p><strong>This is a computer-generated payslip and does not require a signature.</strong></p>
            <p>Generated on {{ now()->format('M d, Y H:i:s') }}</p>
        </div>
    </div>
</body>
</html>
