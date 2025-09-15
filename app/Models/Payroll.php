<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $primaryKey = 'payroll_id';

    protected $fillable = [
        'employee_id', 'month', 'year',
        'gross_salary', 'total_deductions',
        'bonuses', 'net_salary', 'generated_at'
    ];

    protected $casts = [
        'generated_at' => 'datetime',
        'gross_salary' => 'decimal:2',
        'total_deductions' => 'decimal:2',
        'bonuses' => 'decimal:2',
        'net_salary' => 'decimal:2',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
