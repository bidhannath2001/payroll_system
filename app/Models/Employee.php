<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
     protected $fillable = [
        'first_name', 'last_name', 'dob', 'gender', 'designation',
        'department', 'joining_date', 'employment_type', 'salary_range',
        'bonus_eligibility', 'benefits', 'phone', 'email', 'password', 'address',
        'emergency_contact_name', 'emergency_contact_phone',
        'resume', 'id_proof'
    ];
}
