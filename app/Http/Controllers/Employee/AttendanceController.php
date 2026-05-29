<?php

namespace App\Http\Controllers\Employee;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
   // LOGIN EMPLOYEE
        $employee = auth()->user()->employee;

        // EMPLOYEE ID
        $employeeId = $employee->id;

        // TODAY DATE
        $today = Carbon::today()->toDateString();

        // TODAY ATTENDANCE
        $attendance = Attendance::where('employee_id', $employeeId)
            ->whereDate('attendance_date', $today)
            ->first();

        // ONLY LOGIN EMPLOYEE ATTENDANCE
        $attendances = Attendance::with('employee')
            ->where('employee_id', $employeeId)
            ->latest()
            ->paginate(10);

        return view('employee.attendance.index', compact(
            'attendance',
            'attendances'
        ));
    }


    // CHECK IN

}
