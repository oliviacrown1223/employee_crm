<?php

namespace App\Models\SuperAdmin;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    protected $fillable = [
        'employee_id',
        'attendance_score',
        'task_completion_score',
        'manager_rating',
        'final_rating',
        'rating_grade',
        'self_rating',
        'month'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    // KPI CALCULATION
    public static function calculateFinal($a, $t, $m)
    {
        return round(($a * 0.3) + ($t * 0.4) + ($m * 0.3));
    }

    // GRADE SYSTEM
    public static function getGrade($rating)
    {
        return match (true) {
            $rating >= 90 => 'A+',
            $rating >= 80 => 'A',
            $rating >= 70 => 'B',
            $rating >= 60 => 'C',
            default => 'D'
        };
    }
}
