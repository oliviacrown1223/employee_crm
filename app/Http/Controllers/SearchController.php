<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\SuperAdmin\DailyWork;
use App\Models\SuperAdmin\Leave;
use App\Models\SuperAdmin\Performance;
use App\Models\SuperAdmin\Salary;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function liveSearch(Request $request)
    {
        $q = trim($request->q);

        if ($q == '') {
            return response()->json([]);
        }

        $results = collect();

        $employees = Employee::where('name', 'like', "%{$q}%")
            ->orWhere('email', 'like', "%{$q}%")
            ->orWhere('mobile', 'like', "%{$q}%")
            ->orWhere('department', 'like', "%{$q}%")
            ->orWhere('designation', 'like', "%{$q}%")
            ->limit(5)
            ->get();

        foreach ($employees as $employee) {
            $results->push([
                'title' => $employee->name,
                'subtitle' => $employee->email . ' | ' . $employee->department,
                'type' => 'Employee',
                'url' => route('employees.index'),
            ]);
        }

        $users = User::where('name', 'like', "%{$q}%")
            ->orWhere('email', 'like', "%{$q}%")
            ->limit(5)
            ->get();

        foreach ($users as $user) {
            $results->push([
                'title' => $user->name,
                'subtitle' => $user->email,
                'type' => 'User',
                'url' => route('users.index'),
            ]);
        }

        $attendances = Attendance::with('employee')
            ->where('status', 'like', "%{$q}%")
            ->orWhere('attendance_date', 'like', "%{$q}%")
            ->limit(5)
            ->get();

        foreach ($attendances as $attendance) {
            $results->push([
                'title' => $attendance->employee->name ?? 'Attendance',
                'subtitle' => $attendance->attendance_date . ' | ' . $attendance->status,
                'type' => 'Attendance',
                'url' => route('attendance.index'),
            ]);
        }

        $salaries = Salary::with('employee')
            ->where('salary_month', 'like', "%{$q}%")
            ->orWhere('payment_status', 'like', "%{$q}%")
            ->limit(5)
            ->get();

        foreach ($salaries as $salary) {
            $results->push([
                'title' => $salary->employee->name ?? 'Salary',
                'subtitle' => $salary->salary_month . ' | ' . $salary->payment_status,
                'type' => 'Salary',
                'url' => route('salary.index'),
            ]);
        }

        $works = DailyWork::where('task_title', 'like', "%{$q}%")
            ->orWhere('task_description', 'like', "%{$q}%")
            ->orWhere('status', 'like', "%{$q}%")
            ->limit(5)
            ->get();

        foreach ($works as $work) {
            $results->push([
                'title' => $work->task_title,
                'subtitle' => $work->status,
                'type' => 'Daily Work',
                'url' => route('daily-work.index'),
            ]);
        }

        $performances = Performance::with('employee')
            ->where('month', 'like', "%{$q}%")
            ->orWhere('rating_grade', 'like', "%{$q}%")
            ->limit(5)
            ->get();

        foreach ($performances as $performance) {
            $results->push([
                'title' => $performance->employee->name ?? 'Performance',
                'subtitle' => $performance->month . ' | ' . $performance->rating_grade,
                'type' => 'Performance',
                'url' => route('performance.index'),
            ]);
        }

        $leaves = Leave::with('employee')
            ->where('leave_type', 'like', "%{$q}%")
            ->orWhere('approval_status', 'like', "%{$q}%")
            ->orWhere('reason', 'like', "%{$q}%")
            ->limit(5)
            ->get();

        foreach ($leaves as $leave) {
            $results->push([
                'title' => $leave->employee->name ?? 'Leave',
                'subtitle' => $leave->leave_type . ' | ' . $leave->approval_status,
                'type' => 'Leave',
                'url' => route('leave.index'),
            ]);
        }

        return response()->json($results->values());
    }
}
