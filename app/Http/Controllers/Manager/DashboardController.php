<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\SuperAdmin\DailyWork;
use App\Models\SuperAdmin\Performance;

class DashboardController extends Controller
{
    public function index()
    {
        // TOTAL TEAM EMPLOYEES
        $totalEmployees = Employee::count();

        // TOTAL ATTENDANCE
        $totalAttendance = Attendance::count();

        // TOTAL TASKS
        $totalTasks = DailyWork::count();

        // TOTAL PERFORMANCE
        $totalPerformance = Performance::count();

        return view('manager.dashboard', compact(
            'totalEmployees',
            'totalAttendance',
            'totalTasks',
            'totalPerformance'
        ));
    }
}
