<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\SuperAdmin\DailyWork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DailyWorkController extends Controller
{
    public function index()
    {
        $works = $this->roleWiseQuery()
            ->with(['assignedUser'])
            ->latest()
            ->get();

        return view('panel.daily_work.index', compact('works'));
    }
    public function create()
    {
        $user = auth()->user();

        if (!$user->hasAnyRole(['super-admin', 'manager', 'employee'])) {
            abort(403);
        }

        $employees = Employee::all();

        return view('panel.daily_work.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $rules = [
            'task_title' => 'required|string|max:255',
            'task_description' => 'required|string|min:10',
            'hours_worked' => 'required|numeric|min:0.5|max:24',
            'work_date' => 'required|date',
        ];

        if ($user->hasAnyRole(['super-admin', 'manager'])) {
            $rules['employee_id'] = 'required|exists:employees,id';
        }

        $request->validate($rules);

        if ($user->hasRole('employee')) {

            $employee = Employee::where('user_id', $user->id)
                ->orWhere('email', $user->email)
                ->firstOrFail();

            $employeeId = $employee->id;
            $assignedUserId = $user->id;

        } else {

            $employee = Employee::findOrFail($request->employee_id);

            $employeeId = $employee->id;
            $assignedUserId = $employee->user_id;
        }

        DailyWork::create([
            'employee_id' => $employeeId,
            'user_id' => $user->id,
            'assigned_user_id' => $assignedUserId,
            'task_title' => $request->task_title,
            'task_description' => $request->task_description,
            'hours_worked' => $request->hours_worked,
            'work_date' => $request->work_date,
            'status' => 'draft',
        ]);

        return redirect()
            ->route('daily-work.index')
            ->with('success', 'Daily work saved successfully.');
    }

    public function edit($id)
    {
        $work = DailyWork::findOrFail($id);
        $this->checkWorkAccess($work);

        if ($work->status == 'approved' && auth()->user()->hasRole('employee')) {
            return back()->with('error', 'Approved work cannot be edited');
        }

        return view('panel.daily_work.edit', compact('work'));
    }

    public function update(Request $request, $id)
    {
        $work = DailyWork::findOrFail($id);
        $this->checkWorkAccess($work);

        $validated = $request->validateWithBag('dailywork', [
            'task_title' => 'required|string|max:255',
            'task_description' => 'required|string|min:10',
            'hours_worked' => 'required|numeric|min:0.5|max:24',
            'work_date' => 'required|date',
            'status' => 'nullable|in:draft,pending,approved,rejected',
        ]);

        $work->task_title = $validated['task_title'];
        $work->task_description = $validated['task_description'];
        $work->hours_worked = $validated['hours_worked'];
        $work->work_date = $validated['work_date'];

        if (auth()->user()->hasAnyRole(['super-admin', 'manager'])) {
            $work->status = $validated['status'] ?? $work->status;
        }

        $work->save();

        return redirect()->route('daily-work.index')
            ->with('success', 'Work updated successfully');
    }

    public function submit($id)
    {
        $work = DailyWork::findOrFail($id);

        $user = auth()->user();

        if (!$user->hasRole('employee')) {
            abort(403);
        }

        if ($work->assigned_user_id != $user->id) {
            abort(403);
        }

        if ($work->status != 'draft') {
            return back()->with('error', 'Only draft work can be submitted');
        }

        $work->update([
            'status' => 'pending',
            'submitted_at' => now(),
        ]);

        return back()->with('success', 'Work submitted successfully');
    }

    public function approve($id)
    {
        if (!auth()->user()->hasAnyRole(['super-admin', 'manager'])) {
            abort(403);
        }

        $work = DailyWork::findOrFail($id);

        $work->update([
            'status' => 'approved'
        ]);

        return back()->with('success', 'Work approved');
    }

    public function reject($id)
    {
        if (!auth()->user()->hasAnyRole(['super-admin', 'manager'])) {
            abort(403);
        }

        $work = DailyWork::findOrFail($id);

        $work->update([
            'status' => 'rejected'
        ]);

        return back()->with('success', 'Work rejected');
    }

    public function destroy($id)
    {
        $work = DailyWork::findOrFail($id);

        if (!auth()->user()->hasRole('super-admin')) {
            abort(403);
        }

        $work->delete();

        return back()->with('success', 'Deleted successfully');
    }

    public function search(Request $request)
    {
        $query = $this->roleWiseQuery();

        if ($request->status && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('task_title', 'like', "%{$request->search}%")
                    ->orWhere('task_description', 'like', "%{$request->search}%");
            });
        }

        $works = $query->with(['assignedUser'])
            ->latest()
            ->get();

        return view('panel.daily_work.partials.table', compact('works'));
    }

    private function roleWiseQuery()
    {
        $user = Auth::user();

        $query = DailyWork::query();

        if ($user->hasRole('employee')) {

            $employee = Employee::where('user_id', $user->id)
                ->orWhere('email', $user->email)
                ->first();

            $query->where(function ($q) use ($user, $employee) {

                // old data: user_id login user
                $q->where('user_id', $user->id)

                    // old data: assigned_user_id employee user id
                    ->orWhere('assigned_user_id', $user->id);

                // new data: employee_id employee table id
                if ($employee) {
                    $q->orWhere('employee_id', $employee->id);
                }
            });
        }

        return $query;

    }

    private function checkWorkAccess($work)
    {
        $user = auth()->user();

        if ($user->hasAnyRole(['super-admin', 'manager'])) {
            return true;
        }

        if ($user->hasRole('employee')) {

            $employee = Employee::where('user_id', $user->id)
                ->orWhere('email', $user->email)
                ->first();

            if (
                $work->user_id == $user->id ||
                $work->assigned_user_id == $user->id ||
                ($employee && $work->employee_id == $employee->id)
            ) {
                return true;
            }
        }

        abort(403);
    }
}
