<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\SuperAdmin\Leave;
use App\Models\SuperAdmin\Salary;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEmployees = Employee::count();

        $presentEmployees = Attendance::whereDate('created_at', today())
            ->where('status', 'Present')
            ->count();

        $leaveEmployees = Leave::where('approval_status', 'Approved')->count();

        $totalSalary = Salary::sum('net_salary');

        return view('hr.dashboard.index', compact(
            'totalEmployees',
            'presentEmployees',
            'leaveEmployees',
            'totalSalary'
        ));
    }
}
