<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\SuperAdmin\Leave;
use App\Models\SuperAdmin\Performance;
use App\Models\SuperAdmin\Salary;
use App\Models\User;
use Illuminate\Http\Request;


class ReportController extends  Controller
{
    public function index()
{
    $employees = User::count();

    $attendance = Attendance::count();

    $presentEmployees = Attendance::whereDate(
        'created_at',
        today()
    )
        ->where('status', 'Present')
        ->count();

    $salary = Salary::sum('net_salary');

    $performances = Performance::count();

    $averageRating = Performance::avg('final_rating');

    $leaves = Leave::count();

    $pendingLeaves = Leave::where(
        'approval_status',
        'Pending'
    )->count();

    return view(
        'hr.reports.index',
        compact(
            'employees',
            'attendance',
            'presentEmployees',
            'salary',
            'performances',
            'averageRating',
            'leaves',
            'pendingLeaves'
        )
    );
}
}
