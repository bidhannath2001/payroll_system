<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Employee extends Model
{
    use HasFactory;

    protected $primaryKey = 'employee_id';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'dob',
        'gender',
        'address',
        'phone',
        'designation',
        'department_id',
        'role_id',
        'date_joined',
        'status',
        'available_leave',
        'id_proof',
        'resume'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function payrolls()
    {
        return $this->hasMany(Payroll::class, 'employee_id');
    }

    public function salaries()
    {
        return $this->hasMany(Salary::class, 'employee_id');
    }

     public function attendances()
    {
        return $this->hasMany(Attendence::class, 'employee_id', 'employee_id');
    }

    public function bonusDeductions()
    {
        return $this->hasMany(BonusDeduction::class, 'employee_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'employee_id');
    }

    // Auto create user when employee is created
    protected static function booted()
    {
        static::created(function ($employee) {
            User::create([
                'employee_id'   => $employee->employee_id,
                'username'      => $employee->email,
                'password_hash' => 'default123',
                'date_joined'   => $employee->date_joined,
                'role_id'       => $employee->role_id,
                'last_login'    => null,
            ]);
        });
    }
}
