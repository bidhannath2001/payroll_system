<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'dob', 'gender', 'designation', 'department_id', 'role_id',
        'joining_date', 'employment_type', 'salary_range', 'phone', 'email', 'address',
        'emergency_contact_name', 'emergency_contact_phone', 'resume', 'id_proof'
    ];

    // Optional: If you have a table name different from 'jobs'
    protected $table = 'jobs';

    // Optional: If you need timestamps (usually included by default)
    public $timestamps = true;
}