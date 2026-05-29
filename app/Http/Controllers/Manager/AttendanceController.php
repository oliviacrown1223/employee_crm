<?php

namespace App\Http\Controllers\Manager;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {

    $today = \Carbon\Carbon::today()->toDateString();



        $employees = Employee::with(['attendance' => function ($q) use ($today) {
            $q->where('attendance_date', $today);
        }])->get();


        /*
        |--------------------------------------------------------------------------
        | TEAM ATTENDANCES
        |--------------------------------------------------------------------------
        */

        $attendances = Attendance::with('employee')
            ->latest()
            ->paginate(10);
        /*

        /*
        |--------------------------------------------------------------------------
        | CARDS
        |--------------------------------------------------------------------------
        */

        $totalEmployees = $employees->count();
        $presentToday = Attendance::whereDate('attendance_date', $today)
            ->where('status', 'present')
            ->count();


       /* $presentToday = Attendance::whereDate('attendance_date', $today)
            ->where('status', 'present')
            ->whereHas('employee', function ($q) {

                $q->where('manager_id', Auth::id());

            })
            ->count();*/

        $lateToday = Attendance::whereDate('attendance_date', $today)
            ->where('is_late', 1)
            ->whereHas('employee', function ($q) {

                $q->where('manager_id', Auth::id());

            })
            ->count();

        $absentToday = $totalEmployees - $presentToday;

        return view('manager.attendance.index', compact(
            'employees',
            'attendances',
            'totalEmployees',
            'presentToday',
            'lateToday',
            'absentToday'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | CHECK IN
    |--------------------------------------------------------------------------
    */

    public function checkIn($employeeId)
    {
        $today = Carbon::today()->toDateString();

        $attendance = Attendance::firstOrCreate([

            'employee_id' => $employeeId,
            'attendance_date' => $today

        ]);

        if ($attendance->check_in) {

            return response()->json([
                'status' => false,
                'message' => 'Already checked in'
            ]);
        }

        $now = Carbon::now();

        $attendance->check_in = $now;

        $attendance->status = 'present';

        $lateTime = Carbon::createFromTime(10, 0, 0);

        $attendance->is_late = $now->gt($lateTime);

        $attendance->save();

        return response()->json([
            'status' => true,
            'message' => 'Check-In successful'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | CHECK OUT
    |--------------------------------------------------------------------------
    */

    public function checkOut($attendanceId)
    {
        $attendance = Attendance::findOrFail($attendanceId);

        if (!$attendance->check_in) {

            return response()->json([
                'status' => false,
                'message' => 'Please check-in first'
            ]);
        }

        if ($attendance->check_out) {

            return response()->json([
                'status' => false,
                'message' => 'Already checked out'
            ]);
        }

        $attendance->check_out = now();
        $checkIn = Carbon::parse($attendance->check_in);
        $checkOut = Carbon::parse($attendance->check_out);
        $attendance->working_hours =
            round($checkIn->diffInMinutes($checkOut) / 60, 2);
        $attendance->save();
        return response()->json([
            'status' => true,
            'message' => 'Check-Out successful'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | APPROVE
    |--------------------------------------------------------------------------
    */

    public function approve($id)
    {
        $attendance = Attendance::findOrFail($id);

        $attendance->is_approved = true;

        $attendance->approved_at = now();

        $attendance->save();

        return response()->json([
            'status' => true,
            'message' => 'Attendance approved successfully'
        ]);
    }
}
