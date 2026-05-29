<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\SuperAdmin\DailyWork;
use App\Models\SuperAdmin\Leave;
use App\Models\SuperAdmin\Performance;
use App\Models\SuperAdmin\Salary;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $employees = User::count();

        $attendance = Attendance::count();

        $salary = Salary::sum('net_salary');

        $dailyWorks = DailyWork::count();

        $performances = Performance::count();

        $leaves = Leave::count();

        return view('SuperAdmin.reports.index', compact(
            'employees',
            'attendance',
            'salary',
            'dailyWorks',
            'performances',
            'leaves'
        ));
    }
}
