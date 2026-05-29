<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\SuperAdmin\Leave;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeLeaveController extends Controller
{
    public function index()
    {

        $leaves = Leave::with('employee')->latest()->get();

        return view('employee.leave.index', compact('leaves'));
    }


    // CREATE FORM
    public function create()
    {
        $employees = Employee::all();

        return view('employee.leave.create', compact('employees'));
    }


    // STORE LEAVE
    public function store(Request $request)
    {
        $request->validate([

            'employee_id' => 'required',
            'leave_type' => 'required',
            'leave_date' => 'required|date',
            'reason' => 'required',

        ]);
        $employee = Employee::where('email', Auth::user()->email)->first();
        Leave::create([

            'employee_id' => $employee->id,

            'leave_type' => $request->leave_type,
            'leave_date' => $request->leave_date,
            'reason' => $request->reason,
            'approval_status' => 'Pending',

        ]);

        return redirect()
            ->route('employee.leave.index')
            ->with('success', 'Leave Applied Successfully');
    }


    // EDIT (ONLY IF PENDING)
    public function edit($id)
    {
        $leave = Leave::findOrFail($id);

        return view('employee.leave.edit', compact('leave'));
    }


    // UPDATE
    public function update(Request $request, $id)
    {
        $leave = Leave::findOrFail($id);

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
            ->route('employee.leave.index')
            ->with('success', 'Leave Updated Successfully');
    }
    public function destroy($id)
    {
        $leave = Leave::findOrFail($id);
        $leave->delete();

        return redirect()
            ->route('employee.leave.index')
            ->with('success', 'Leave Deleted Successfully');
    }
}
