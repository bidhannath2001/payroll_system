<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run()
    {
        Department::insert([
            ['department_name' => 'HR'],
            ['department_name' => 'Finance'],
            ['department_name' => 'IT'],
            ['department_name' => 'Management'],
            ['department_name' => 'Architecture'],
            ['department_name' => 'Engineering'],
        ]);
    }
}
