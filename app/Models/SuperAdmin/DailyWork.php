<?php

namespace App\Models\SuperAdmin;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class DailyWork extends Model
{
    protected $fillable = [
        'user_id',
        'task_title',
        'task_description',
        'hours_worked',
        'status',
        'submission_date',
        'submitted_at',
        'assigned_user_id',
        'work_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class,
            'user_id');
    }
}
