<?php

namespace App\Models\SuperAdmin;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class DailyWork extends Model
{
    protected $fillable = [
        'employee_id',
        'user_id',
        'assigned_user_id',
        'task_title',
        'task_description',
        'hours_worked',
        'work_date',
        'status',
        'submitted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
