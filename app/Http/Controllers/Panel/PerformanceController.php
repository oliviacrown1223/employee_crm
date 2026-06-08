<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\SuperAdmin\Performance;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PerformanceExport;

class PerformanceController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $query = Performance::with('employee');

        if ($user->hasRole('employee')) {
            $employee = Employee::where('user_id', $user->id)
                ->orWhere('email', $user->email)
                ->first();

            if ($employee) {
                $query->where('employee_id', $employee->id);
            } else {
                $query->whereRaw('1 = 0');
            }
        }

        // Manager team filter future:
        // elseif ($user->hasRole('manager')) {
        //     $query->whereHas('employee', fn($q) => $q->where('manager_id', $user->id));
        // }

        $performances = $query->latest()->get();

        return view('panel.performance.index', compact('performances'));
    }

    public function create()
    {
        if (!auth()->user()->hasAnyRole(['super-admin', 'manager'])) {
            abort(403);
        }

        $employees = Employee::all();

        return view('panel.performance.create', compact('employees'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->hasAnyRole(['super-admin', 'manager'])) {
            abort(403);
        }

        $validated = $request->validateWithBag('performance', [
            'employee_id' => 'required|exists:employees,id',
            'month' => 'required',
            'attendance_score' => 'required|numeric|min:0|max:100',
            'task_completion_score' => 'required|numeric|min:0|max:100',
            'manager_rating' => 'required|numeric|min:0|max:5',
        ]);

        $rating = round((
                $validated['attendance_score'] +
                $validated['task_completion_score'] +
                $validated['manager_rating']
            ) / 3, 1);

        $grade = Performance::getGrade($rating);

        Performance::create([
            'employee_id' => $validated['employee_id'],
            'attendance_score' => $validated['attendance_score'],
            'task_completion_score' => $validated['task_completion_score'],
            'manager_rating' => $validated['manager_rating'],
            'final_rating' => $rating,
            'rating_grade' => $grade,
            'month' => $validated['month'],
        ]);

        return redirect()->route('performance.index')
            ->with('success', 'Performance rating generated successfully.');
    }

    public function edit($id)
    {
        if (!auth()->user()->hasAnyRole(['super-admin', 'manager'])) {
            abort(403);
        }

        $performance = Performance::findOrFail($id);
        $employees = Employee::all();

        return view('panel.performance.edit', compact('performance', 'employees'));
    }

    public function update(Request $request, $id)
    {
        if (!auth()->user()->hasAnyRole(['super-admin', 'manager'])) {
            abort(403);
        }

        $performance = Performance::findOrFail($id);

        $validated = $request->validateWithBag('performance', [
            'employee_id' => 'required|exists:employees,id',
            'month' => 'required',
            'attendance_score' => 'required|numeric|min:0|max:100',
            'task_completion_score' => 'required|numeric|min:0|max:100',
            'manager_rating' => 'required|numeric|min:0|max:5',
        ]);

        $rating = round((
                $validated['attendance_score'] +
                $validated['task_completion_score'] +
                $validated['manager_rating']
            ) / 3, 1);

        $grade = Performance::getGrade($rating);

        $performance->update([
            'employee_id' => $validated['employee_id'],
            'month' => $validated['month'],
            'attendance_score' => $validated['attendance_score'],
            'task_completion_score' => $validated['task_completion_score'],
            'manager_rating' => $validated['manager_rating'],
            'final_rating' => $rating,
            'rating_grade' => $grade,
        ]);

        return redirect()->route('performance.index')
            ->with('success', 'Performance updated successfully.');
    }

    public function show($id)
    {
        $performance = Performance::with('employee')->findOrFail($id);

        if (auth()->user()->hasRole('employee')) {
            $employee = Employee::where('user_id', auth()->id())
                ->orWhere('email', auth()->user()->email)
                ->first();

            if (!$employee || $performance->employee_id != $employee->id) {
                abort(403);
            }
        }

        return view('panel.performance.view', compact('performance'));
    }

    public function export()
    {
        if (!auth()->user()->hasAnyRole(['super-admin', 'hr'])) {
            abort(403);
        }

        return Excel::download(new PerformanceExport, 'performance.xlsx');
    }

    public function monthlyReport()
    {
        if (!auth()->user()->hasAnyRole(['super-admin', 'hr', 'manager'])) {
            abort(403);
        }

        $data = Performance::selectRaw('month, AVG(final_rating) as avg_rating')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('panel.performance.monthly_report', compact('data'));
    }

    public function employeeGraph($id)
    {
        $data = Performance::where('employee_id', $id)
            ->orderBy('month')
            ->get();

        return view('panel.performance.employee', compact('data'));
    }
    public function selfRating(Request $request, $id)
    {
        $request->validate([
            'self_rating' => 'required|integer|min:1|max:5'
        ]);

        $performance = Performance::findOrFail($id);

        // Employee પોતાનું જ record update કરી શકે
        $employee = Employee::where('user_id', auth()->id())
            ->orWhere('email', auth()->user()->email)
            ->first();

        if (!$employee || $performance->employee_id != $employee->id) {
            abort(403);
        }

        $performance->update([
            'self_rating' => $request->self_rating
        ]);

        return redirect()
            ->route('performance.index')
            ->with('success', 'Rating submitted successfully.');
    }
}
