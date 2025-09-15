<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonusDeduction extends Model
{
    use HasFactory;

    protected $table = 'bonus_deductions';

    protected $fillable = [
        'employee_id', 'type', 'amount', 'reason', 'date'
    ];

    protected $casts = [
        'date' => 'date',
        'amount' => 'decimal:2',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
