<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Salary;

class SalarySeeder extends Seeder
{
    public function run()
    {
        $employees = Employee::all();
        
        foreach ($employees as $employee) {
            Salary::create([
                'employee_id' => $employee->employee_id,
                'basic_salary' => rand(3000, 8000), 
                'allowances' => rand(200, 1000), 
                'deductions' => rand(100, 500), // Random 
                'tax_percentage' => rand(10, 25), // Random 
            ]);
        }
    }
}




