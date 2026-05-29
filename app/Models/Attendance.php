<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Attendance extends Model
{
    protected $fillable = [

        'employee_id',
        'attendance_date',
        'check_in',
        'check_out',
        'working_hours',
        'is_late',
        'status',
        'is_approved',
        'approved_at'

    ];

    public function employee()
    {
        return $this->belongsTo(\App\Models\Employee::class, 'employee_id');
    }
}
