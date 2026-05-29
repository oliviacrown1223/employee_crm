<?php

namespace App\Models\SuperAdmin;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $fillable = [
        'employee_name',
        'employee_id',
        'leave_type',
        'leave_date',
        'reason',
        'approval_status',

    ];

    public function employee()
    {
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }
}
