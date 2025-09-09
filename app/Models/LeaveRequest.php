<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    //
    protected $primaryKey = 'leave_request_id';
    protected $fillable = [
        'employee_id',
        'leave_type',
        'start_date',
        'end_date',
        'reason',
        'available_leaves',
        'status',
    ]; 

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
