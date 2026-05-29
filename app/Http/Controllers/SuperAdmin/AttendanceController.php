<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $today = Carbon::today()->toDateString();

        $totalEmployees = Employee::count();

        $presentToday = Attendance::whereDate('attendance_date', $today)
            ->where('status', 'present')
            ->count();

        $absentToday = $totalEmployees - $presentToday;

        $lateToday = Attendance::whereDate('attendance_date', $today)
            ->where('is_late', 1)
            ->count();

        $today = Carbon::today()->toDateString();

        $employees = Employee::with(['attendance' => function ($q) use ($today) {
            $q->where('attendance_date', $today);
        }])->get();

        $attendances = Attendance::with('employee')
            ->latest()
            ->paginate(10);

        return view('SuperAdmin.attendance.index', compact(
            'totalEmployees',
            'presentToday',
            'absentToday',
            'lateToday',
            'employees',
            'attendances'
        ));
    }


    public function markAttendance(Request $request)
    {
        $request->validate([
            'employee_id' => 'required',
            'status' => 'required'
        ]);

        $today = Carbon::today()->toDateString();

        $already = Attendance::where('employee_id', $request->employee_id)
            ->whereDate('attendance_date', $today)
            ->exists();

        if ($already) {

            return response()->json([
                'status' => false,
                'message' => 'Attendance already marked'
            ]);
        }

        $now = Carbon::now();

        $lateTime = Carbon::createFromTime(10, 0, 0);

        Attendance::create([

            'employee_id' => $request->employee_id,

            'attendance_date' => $today,

            'check_in' => $now,

            'status' => $request->status,

            'is_late' => $now->gt($lateTime),

            'working_hours' => 0

        ]);

        return response()->json([
            'status' => true,
            'message' => 'Attendance marked successfully'
        ]);
    }

    // CHECK IN

    public function checkIn($id)
    {
        $today = Carbon::today()->toDateString();

        // 1. Find or create today's attendance
        $attendance = Attendance::firstOrCreate(
            [
                'employee_id' => $id,
                'attendance_date' => $today,
            ]
        );

        // 2. If already checked in
        if ($attendance->check_in) {
            return response()->json([
                'status' => false,
                'message' => 'Already checked in'
            ]);
        }
        // ❌ AFTER 5 PM block check-in
        $checkInCloseTime = Carbon::createFromTime(17, 0, 0);

        if (now()->gt($checkInCloseTime)) {
            return response()->json([
                'status' => false,
                'message' => 'Check-in time is over'
            ]);
        }

        // 3. Mark check-in time
        $attendance->check_in = now()->format('H:i:s');

        // 4. Late logic
        // ✅ AUTO STATUS FIX HERE
        $attendance->status = 'present';

        $lateTime = Carbon::createFromTime(12, 0, 0);
        $attendance->is_late = now()->gt($lateTime);

        $attendance->save();

        return response()->json([
            'status' => true,
            'message' => 'Check-In successful'
        ]);
    }

    // CHECK OUT

    public function checkOut($id)
    {
        $attendance = Attendance::findOrFail($id);

        // MUST CHECK IN FIRST

        if(!$attendance->check_in){

            return response()->json([
                'status' => false,
                'message' => 'Please check-in first'
            ]);
        }

        // ALREADY CHECKED OUT

        if($attendance->check_out){

            return response()->json([
                'status' => false,
                'message' => 'Already checked out'
            ]);
        }

        $attendance->check_out = now();

        // WORKING HOURS

        $checkIn = \Carbon\Carbon::parse($attendance->check_in);

        $checkOut = \Carbon\Carbon::parse($attendance->check_out);

        $hours = $checkIn->diffInMinutes($checkOut) / 60;

        $attendance->working_hours = round($hours, 2);

        $attendance->save();

        return response()->json([
            'status' => true,
            'message' => 'Check-Out successful'
        ]);
    }

    // APPROVE

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

    // EDIT PAGE

    public function edit($id)
    {
        $attendance = Attendance::with('employee')->findOrFail($id);

        return view('SuperAdmin.attendance.edit', compact('attendance'));
    }

    // UPDATE

    public function update(Request $request, $id)
    {
        $request->validate([

            'check_in' => 'required',

            'check_out' => 'nullable',

            'status' => 'required'

        ]);

        $attendance = Attendance::findOrFail($id);

        // WORKING HOURS

        $hours = 0;

        if($request->check_out){

            $checkIn = \Carbon\Carbon::parse($request->check_in);

            $checkOut = \Carbon\Carbon::parse($request->check_out);

            $hours = $checkIn->diffInMinutes($checkOut) / 60;
        }

        $attendance->update([

            'check_in' => $request->check_in,

            'check_out' => $request->check_out,

            'status' => $request->status,

            'working_hours' => round($hours, 2)

        ]);

        return redirect()
            ->route('attendance.index')
            ->with('success', 'Attendance updated successfully');
    }

}
