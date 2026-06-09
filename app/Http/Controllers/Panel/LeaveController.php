<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\SuperAdmin\Leave;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function index()
    {
        $user = Auth::user();


        Leave::where('approval_status', 'Pending')
            ->whereDate('leave_date', '<', Carbon::today())
            ->update([
                'approval_status' => 'Rejected',
            ]);

        if ($user->hasAnyRole(['super-admin', 'hr'])) {

            $leaves = Leave::with('employee')
                ->latest()
                ->get();

        } else {

            $employee = Employee::where('user_id', $user->id)
                ->orWhere('email', $user->email)
                ->first();

            if ($employee) {
                $leaves = Leave::with('employee')
                    ->where('employee_id', $employee->id)
                    ->latest()
                    ->get();
            } else {
                $leaves = collect();
            }
        }

        return view('panel.leave.index', compact('leaves'));
    }

    public function create()
    {
        $employees = [];

        if (auth()->user()->hasAnyRole(['super-admin', 'hr'])) {
            $employees = Employee::all();
        }

        return view('panel.leave.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $rules = [
            'leave_type' => 'required',
            'leave_date' => 'required|date',
            'reason' => 'required',
        ];

        if ($user->hasAnyRole(['super-admin', 'hr'])) {
            $rules['employee_id'] = 'required|exists:employees,id';
        }

        $request->validate($rules);

        if ($user->hasRole('employee')) {

            $employee = Employee::where('user_id', $user->id)
                ->orWhere('email', $user->email)
                ->firstOrFail();

            $employeeId = $employee->id;

        } else {

            $employeeId = $request->employee_id;
        }

        Leave::create([
            'employee_id' => $employeeId,
            'leave_type' => $request->leave_type,
            'leave_date' => $request->leave_date,
            'reason' => $request->reason,
            'approval_status' => 'Pending',
        ]);

        return redirect()
            ->route('leave.index')
            ->with('success', 'Leave applied successfully');
    }

    public function edit($id)
    {
        $leave = Leave::findOrFail($id);

        $this->checkLeaveAccess($leave);

        if (
            auth()->user()->hasRole('employee') &&
            $leave->approval_status != 'Pending'
        ) {
            return back()->with('error', 'Approved or rejected leave cannot be edited');
        }

        return view('panel.leave.edit', compact('leave'));
    }

    public function update(Request $request, $id)
    {
        $leave = Leave::findOrFail($id);

        $this->checkLeaveAccess($leave);

        if (
            auth()->user()->hasRole('employee') &&
            $leave->approval_status != 'Pending'
        ) {
            return back()->with('error', 'Approved or rejected leave cannot be updated');
        }

        $request->validate([
            'leave_type' => 'required',
            'leave_date' => 'required|date',
            'reason' => 'required',
        ]);

        $leave->update([
            'leave_type' => $request->leave_type,
            'leave_date' => $request->leave_date,
            'reason' => $request->reason,
        ]);

        return redirect()
            ->route('leave.index')
            ->with('success', 'Leave updated successfully');
    }

    public function approve($id)
    {
        if (!auth()->user()->hasAnyRole(['super-admin', 'hr'])) {
            abort(403);
        }

        $leave = Leave::findOrFail($id);

        $leave->update([
            'approval_status' => 'Approved',
        ]);

        return back()->with('success', 'Leave approved');
    }

    public function reject($id)
    {
        if (!auth()->user()->hasAnyRole(['super-admin', 'hr'])) {
            abort(403);
        }

        $leave = Leave::findOrFail($id);

        $leave->update([
            'approval_status' => 'Rejected',
        ]);

        return back()->with('success', 'Leave rejected');
    }

    public function destroy($id)
    {
        $leave = Leave::findOrFail($id);

        if (!auth()->user()->hasRole('super-admin')) {
            abort(403);
        }

        $leave->delete();

        return back()->with('success', 'Leave deleted successfully');
    }

    private function checkLeaveAccess($leave)
    {
        $user = auth()->user();

        if ($user->hasAnyRole(['super-admin', 'hr'])) {
            return true;
        }

        if ($user->hasRole('employee')) {

            $employee = Employee::where('user_id', $user->id)
                ->orWhere('email', $user->email)
                ->first();

            if ($employee && $leave->employee_id == $employee->id) {
                return true;
            }
        }

        abort(403);
    }
}
