<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\SuperAdmin\Leave;
use App\Models\SuperAdmin\Performance;
use App\Models\SuperAdmin\Salary;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $employeeId = Auth::id();

        return view('employee.dashboard', [
            'attendanceCount' =>   Attendance::count(),
            'totalSalary'       => Salary::sum('net_salary'),
            'performance'     =>  Performance::count(),
            'leaveCount'      => Leave::where('employee_id', $employeeId)->count(),
        ]);
    }
}
