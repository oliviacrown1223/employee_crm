<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $today = Carbon::today()->toDateString();

        if ($user->hasRole('employee')) {

            $employees = Employee::where('user_id', $user->id)
                ->orWhere('email', $user->email)
                ->with(['attendance' => function ($q) use ($today) {
                    $q->whereDate('attendance_date', $today);
                }])
                ->get();

        } elseif ($user->hasRole('manager')) {

            // હાલ manager_id column નથી એટલે manager ને બધા employees view કરાવ્યા છે.
            // Team wise કરવું હોય તો employees table માં manager_id add કરવું પડશે.
            $employees = Employee::with(['attendance' => function ($q) use ($today) {
                $q->whereDate('attendance_date', $today);
            }])->get();

        } else {

            // Super Admin + HR
            $employees = Employee::with(['attendance' => function ($q) use ($today) {
                $q->whereDate('attendance_date', $today);
            }])->get();
        }

        $employeeIds = $employees->pluck('id');

        $totalEmployees = $employees->count();

        $presentToday = Attendance::whereIn('employee_id', $employeeIds)
            ->whereDate('attendance_date', $today)
            ->where('status', 'present')
            ->count();

        $absentToday = $totalEmployees - $presentToday;

        $lateToday = Attendance::whereIn('employee_id', $employeeIds)
            ->whereDate('attendance_date', $today)
            ->where('is_late', 1)
            ->count();

        $attendances = Attendance::with('employee')
            ->whereIn('employee_id', $employeeIds)
            ->latest()
            ->paginate(10);

        return view('panel.attendance.index', compact(
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
        if (!auth()->user()->hasAnyRole(['super-admin', 'hr'])) {
            abort(403);
        }

        $request->validate([
            'employee_id' => 'required',
            'status' => 'required',
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
            'check_in' => $request->status == 'present' ? $now->format('H:i:s') : null,
            'status' => $request->status,
            'is_late' => $request->status == 'present' ? $now->gt($lateTime) : 0,
            'working_hours' => 0,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Attendance marked successfully'
        ]);
    }

    public function checkIn($id)
    {
        $user = auth()->user();

        if ($user->hasRole('employee')) {
            $employee = Employee::where('id', $id)
                ->where(function ($q) use ($user) {
                    $q->where('user_id', $user->id)
                        ->orWhere('email', $user->email);
                })
                ->firstOrFail();
        } else {
            $employee = Employee::findOrFail($id);
        }

        $today = Carbon::today()->toDateString();

        $attendance = Attendance::firstOrCreate([
            'employee_id' => $employee->id,
            'attendance_date' => $today,
        ]);

        if ($attendance->check_in) {
            return response()->json([
                'status' => false,
                'message' => 'Already checked in'
            ]);
        }

        $checkInCloseTime = Carbon::createFromTime(17, 0, 0);

        if (now()->gt($checkInCloseTime)) {
            return response()->json([
                'status' => false,
                'message' => 'Check-in time is over'
            ]);
        }

        $lateTime = Carbon::createFromTime(12, 0, 0);

        $attendance->check_in = now()->format('H:i:s');
        $attendance->status = 'present';
        $attendance->is_late = now()->gt($lateTime);
        $attendance->working_hours = 0;
        $attendance->save();

        return response()->json([
            'status' => true,
            'message' => 'Check-In successful'
        ]);
    }

    public function checkOut($id)
    {
        $attendance = Attendance::findOrFail($id);

        if (auth()->user()->hasRole('employee')) {
            $employee = Employee::where('user_id', auth()->id())
                ->orWhere('email', auth()->user()->email)
                ->firstOrFail();

            if ($attendance->employee_id != $employee->id) {
                abort(403);
            }
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
        if (!auth()->user()->hasAnyRole(['super-admin', 'hr', 'manager'])) {
            abort(403);
        }

        $attendance = Attendance::findOrFail($id);

        $attendance->is_approved = true;
        $attendance->approved_at = now();
        $attendance->save();

        return response()->json([
            'status' => true,
            'message' => 'Attendance approved successfully'
        ]);
    }

    public function edit($id)
    {
        if (!auth()->user()->hasAnyRole(['super-admin', 'hr'])) {
            abort(403);
        }

        $attendance = Attendance::with('employee')->findOrFail($id);

        return view('panel.attendance.edit', compact('attendance'));
    }

    public function update(Request $request, $id)
    {
        if (!auth()->user()->hasAnyRole(['super-admin', 'hr'])) {
            abort(403);
        }

        $request->validate([
            'check_in' => 'required',
            'check_out' => 'nullable',
            'status' => 'required',
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
            'working_hours' => round($hours, 2),
        ]);

        return redirect()
            ->route('attendance.index')
            ->with('success', 'Attendance updated successfully');
    }
}
