<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\SuperAdmin\Leave;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // SUPER ADMIN + HR
        if ($user->role == 'super-admin' || $user->role == 'hr') {
            $leaves = Leave::latest()->get();
        } else {
            // EMPLOYEE
            $leaves = Leave::where('employee_id', $user->id)
                ->latest()
                ->get();
        }
        return view('SuperAdmin.leave.index', compact('leaves'));
    }
    /**
     * Create Form
     */
    public function create()
    {
        $employees = [];

        if(Auth::user()->role == 'super-admin') {

                $employees = User::where('role', 'employee')->get();

        }

        return view('SuperAdmin.leave.create', compact('employees'));
    }
    /**
     * Store Leave
     */
    public function store(Request $request)
    {
        // ROLE
        $role = Auth::user()->role;



        // VALIDATION
        if($role == 'super-admin') {

            $request->validate([

                'employee_id' => 'required',

                'leave_type' => 'required',

                'leave_date' => 'required|date',

                'reason' => 'required',

            ]);

        } else {

            $request->validate([

                'leave_type' => 'required',

                'leave_date' => 'required|date',

                'reason' => 'required',

            ]);

        }



        // STORE LEAVE
        Leave::create([

            'employee_id' => $role == 'super-admin'
                ? $request->employee_id
                : Auth::id(),

            'leave_type' => $request->leave_type,

            'leave_date' => $request->leave_date,

            'reason' => $request->reason,

            'approval_status' => 'Pending',

        ]);



        return redirect()
            ->route('leave.index')
            ->with('success', 'Leave Applied Successfully');
    }

    /**
     * Edit Form
     */
    public function edit($id)
    {
        $leave = Leave::findOrFail($id);

        return view('SuperAdmin.leave.edit', compact('leave'));
    }

    /**
     * Update Leave
     */
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
            ->route('leave.index')
            ->with('success', 'Leave Updated Successfully');
    }

    /**
     * Approve Leave
     */
    public function approve($id)
    {
        $leave = Leave::findOrFail($id);

        $leave->update([

            'approval_status' => 'Approved'

        ]);

        return back()->with('success', 'Leave Approved');
    }

    /**
     * Reject Leave
     */
    public function reject($id)
    {
        $leave = Leave::findOrFail($id);

        $leave->update([

            'approval_status' => 'Rejected'

        ]);

        return back()->with('success', 'Leave Rejected');
    }
}
