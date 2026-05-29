<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

        $employees = Employee::with(['attendance' => function ($q) use ($today) {

            $q->where('attendance_date', $today);

        }])->latest()->get();

        return view('hr.attendance.index', compact(
            'totalEmployees',
            'presentToday',
            'absentToday',
            'lateToday',
            'employees'
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

        $checkIn = now();

        $lateTime = Carbon::createFromTime(10, 0, 0);

        Attendance::create([

            'employee_id' => $request->employee_id,

            'attendance_date' => $today,

            'check_in' => $checkIn->format('H:i:s'),

            'status' => $request->status,

            'is_late' => $checkIn->gt($lateTime),

            'working_hours' => 0

        ]);

        return response()->json([
            'status' => true,
            'message' => 'Attendance marked successfully'
        ]);
    }

    public function checkIn($id)
    {
        $today = Carbon::today()->toDateString();

        $attendance = Attendance::firstOrCreate([
            'employee_id' => $id,
            'attendance_date' => $today,
        ]);

        if ($attendance->check_in) {

            return response()->json([
                'status' => false,
                'message' => 'Already checked in'
            ]);
        }

        $attendance->check_in = now()->format('H:i:s');

        $attendance->status = 'present';

        $lateTime = Carbon::createFromTime(10, 0, 0);

        $attendance->is_late = now()->gt($lateTime);

        $attendance->save();

        return response()->json([
            'status' => true,
            'message' => 'Check-In successful'
        ]);
    }

    public function checkOut($id)
    {
        $today = Carbon::today()->toDateString();

        $attendance = Attendance::where('employee_id', $id)
            ->whereDate('attendance_date', $today)
            ->first();

        if (!$attendance) {

            return response()->json([
                'status' => false,
                'message' => 'Attendance not found'
            ]);
        }

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

        $attendance->check_out = now()->format('H:i:s');

        $checkIn = Carbon::parse($attendance->check_in);

        $checkOut = Carbon::parse($attendance->check_out);

        $hours = $checkIn->diffInMinutes($checkOut) / 60;

        $attendance->working_hours = round($hours, 2);

        $attendance->save();

        return response()->json([
            'status' => true,
            'message' => 'Check-Out successful'
        ]);
    }

    public function approve($id)
    {
        $attendance = Attendance::findOrFail($id);

        $attendance->is_approved = 1;

        $attendance->approved_at = now();

        $attendance->save();

        return response()->json([
            'status' => true,
            'message' => 'Attendance approved successfully'
        ]);
    }

    public function edit($id)
    {
        $attendance = Attendance::with('employee')->findOrFail($id);

        return view('hr.attendance.edit', compact('attendance'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([

            'check_in' => 'required',

            'check_out' => 'nullable',

            'status' => 'required'

        ]);

        $attendance = Attendance::findOrFail($id);

        $hours = 0;

        if ($request->check_out) {

            $checkIn = Carbon::parse($request->check_in);

            $checkOut = Carbon::parse($request->check_out);

            $hours = $checkIn->diffInMinutes($checkOut) / 60;
        }

        $attendance->update([

            'check_in' => $request->check_in,

            'check_out' => $request->check_out,

            'status' => $request->status,

            'working_hours' => round($hours, 2)

        ]);

        return redirect()
            ->route('hr.attendance.index')
            ->with('success', 'Attendance updated successfully');
    }

}
