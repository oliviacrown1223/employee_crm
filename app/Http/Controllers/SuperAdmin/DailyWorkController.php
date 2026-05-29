<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;

use App\Models\SuperAdmin\DailyWork;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class DailyWorkController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'employee') {
            $works = DailyWork::where('user_id', $user->id)->latest()->get();
        } else {
            $works = DailyWork::latest()->get();
        }

        return view('SuperAdmin.daily_work.index', compact('works'));
    }

    // CREATE FORM
    public function create()
    {

        $employees = User::where('role', 'employee')->get();

        return view('SuperAdmin.daily_work.create', compact('employees'));

    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([

            'task_title' => [
                'required',
                'string',
                'max:255',
            ],

            'task_description' => [
                'required',
                'string',
                'min:10',
            ],

            'hours_worked' => [
                'required',
                'numeric',
                'min:0.5',
                'max:24',
            ],

            'work_date' => [
                'required',
                'date',
            ],

            'employee_id' => [
                'required',
                'exists:employees,id',
            ],

        ], [

            // TASK TITLE
            'task_title.required' => 'Task title is required.',
            'task_title.max' => 'Task title cannot exceed 255 characters.',

            // DESCRIPTION
            'task_description.required' => 'Task description is required.',
            'task_description.min' => 'Description must be at least 10 characters.',

            // HOURS
            'hours_worked.required' => 'Hours worked is required.',
            'hours_worked.numeric' => 'Hours worked must be numeric.',
            'hours_worked.min' => 'Minimum working hours is 0.5.',
            'hours_worked.max' => 'Hours cannot exceed 24.',

            // DATE
            'work_date.required' => 'Work date is required.',
            'work_date.date' => 'Invalid work date.',

            // EMPLOYEE
            'employee_id.required' => 'Please select employee.',
            'employee_id.exists' => 'Selected employee is invalid.',

        ]);

        DailyWork::create([

            'user_id' => auth()->id(),

            'assigned_user_id' => $request->employee_id,

            'task_title' => $request->task_title,

            'task_description' => $request->task_description,

            'hours_worked' => $request->hours_worked,

            'work_date' => $request->work_date,

            'status' => 'draft',

        ]);

        return redirect()
            ->route('daily-work.index')
            ->with('success', 'Daily work submitted successfully.');
    }

    // EDIT
    public function edit($id)
    {
        $work = DailyWork::findOrFail($id);

        // EMPLOYEE SAFETY CHECK
        if (auth()->user()->role == 'employee' && $work->user_id != auth()->id()) {
            abort(403, 'Unauthorized action');
        }

        // If approved, prevent editing
        if ($work->status == 'approved' && auth()->user()->role == 'employee') {
            return back()->with('error', 'Approved work cannot be edited');
        }

        return view('SuperAdmin.daily_work.edit', compact('work'));
    }
    public function submit($id)
    {
        $work = DailyWork::findOrFail($id);

        // only owner can submit
        if ($work->user_id != auth()->id()) {
            abort(403);
        }

        // prevent double submit
        if ($work->status != 'draft') {
            return back()->with('error', 'Already submitted');
        }

        $work->update([
            'status' => 'pending',
            'submitted_at' => now()
        ]);

        return back()->with('success', 'Work submitted successfully');
    }
    // UPDATE
    public function update(Request $request, $id)
    {
        $work = DailyWork::findOrFail($id);

        $user = auth()->user();

        // FIXED SECURITY CHECK
        if ($user->role == 'employee' && $work->assigned_user_id != $user->id) {
            abort(403);
        }

        $validated = $request->validateWithBag('dailywork', [
            'task_title' => 'required',
            'task_description' => 'required',
            'hours_worked' => 'required|numeric',
            'submission_date' => 'required|date',
            'status' => 'nullable',
        ]);

        $work->task_title = $validated['task_title'];
        $work->task_description = $validated['task_description'];
        $work->hours_worked = $validated['hours_worked'];
        $work->work_date = $validated['submission_date']; // IMPORTANT FIX

        if ($user->role == 'manager' || $user->role == 'super-admin') {
            $work->status = $validated['status'] ?? $work->status;
        }

        $work->save();

        return redirect()->route('daily-work.index')
            ->with('success', 'Work updated successfully');
    }

    // DELETE
    public function destroy($id)
    {
        DailyWork::findOrFail($id)->delete();

        return back()->with('success', 'Deleted successfully');
    }

    // APPROVE
    public function approve($id)
    {
        $work = DailyWork::findOrFail($id);
        $work->status = 'approved';
        $work->save();

        return back()->with('success', 'Work approved');
    }

    // REJECT
    public function reject($id)
    {
        $work = DailyWork::findOrFail($id);
        $work->status = 'rejected';
        $work->save();

        return back()->with('success', 'Work rejected');
    }
    public function search(Request $request)
    {
        $query = DailyWork::query();

        if ($request->status && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('task_title', 'like', "%{$request->search}%")
                    ->orWhere('task_description', 'like', "%{$request->search}%");
            });
        }

        $works = $query->latest()->get();

        return view('SuperAdmin.daily_work.partials.table', compact('works'));
    }
}
