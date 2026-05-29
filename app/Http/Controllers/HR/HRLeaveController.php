<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\SuperAdmin\Leave;
use Illuminate\Http\Request;

class HRLeaveController extends Controller
{
    /**
     * Leave List
     */
    public function index()
    {
        $leaves = Leave::latest()->get();

        return view('hr.leave.index', compact('leaves'));
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

        return back()->with('success', 'Leave Approved Successfully');
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

        return back()->with('success', 'Leave Rejected Successfully');
    }
}
