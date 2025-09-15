<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\BonusDeduction;

class BonusDeductionSeeder extends Seeder
{
    public function run()
    {
        $employees = Employee::all();
        
        foreach ($employees as $employee) {
            // Add some random bonuses for current month
            for ($i = 0; $i < rand(1, 3); $i++) {
                BonusDeduction::create([
                    'employee_id' => $employee->employee_id,
                    'type' => 'Bonus',
                    'amount' => rand(100, 500),
                    'reason' => 'Performance bonus',
                    'date' => now()->subDays(rand(1, 15)), // Current month
                ]);
            }
            
            // Add some random deductions for current month
            for ($i = 0; $i < rand(0, 2); $i++) {
                BonusDeduction::create([
                    'employee_id' => $employee->employee_id,
                    'type' => 'Deduction',
                    'amount' => rand(50, 200),
                    'reason' => 'Late arrival penalty',
                    'date' => now()->subDays(rand(1, 15)), // Current month
                ]);
            }
        }
    }
}




