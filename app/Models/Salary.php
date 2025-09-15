<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    // Specify the table if not default
    protected $table = 'salaries';

    // Specify the primary key
    protected $primaryKey = 'salary_id';

    // If primary key is not auto-incrementing
    public $incrementing = true;

    // Optional: if primary key is not integer
    // protected $keyType = 'int';

    // Specify fillable fields
    protected $fillable = [
        'employee_id',
        'basic_salary',
        'allowances',
        'deductions',
        'tax_percentage',
    ];

    // Relationship to Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }
}
