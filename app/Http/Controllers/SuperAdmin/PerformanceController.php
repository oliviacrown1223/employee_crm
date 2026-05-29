<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\SuperAdmin\Performance;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PerformanceExport;

class PerformanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // LIST (READ)
    public function index()
    {
        $performances = Performance::with('employee')->latest()->get();
        return view('SuperAdmin.performances.index', compact('performances'));
    }

    // CREATE PAGE
    public function create()
    {
        $employees = Employee::all();
        return view('SuperAdmin.performances.create', compact('employees'));
    }

    // STORE (Generate Rating HERE)
    public function store(Request $request)
    {
        $validated = $request->validateWithBag('performance', [

            'employee_id' => 'required|exists:employees,id',

            'month' => 'required',

            'attendance_score' => 'required|numeric|min:0|max:100',

            'task_completion_score' => 'required|numeric|min:0|max:5',

            'manager_rating' => 'required|numeric|min:0|max:5',

        ]);

        $rating = Performance::calculateFinal(

            $validated['attendance_score'],

            $validated['task_completion_score'],

            $validated['manager_rating']

        );

        $grade = Performance::getGrade($rating);

        Performance::create([

            'employee_id' => $validated['employee_id'],

            'attendance_score' => $validated['attendance_score'],

            'task_completion_score' => $validated['task_completion_score'],

            'manager_rating' => $validated['manager_rating'],

            'final_rating' => $rating,

            'rating_grade' => $grade,

            'month' => $validated['month']

        ]);

        return redirect()
            ->route('performance.index')
            ->with('success', 'Performance rating generated successfully.');
    }

    // EDIT RATING
    public function edit($id)
    {
        $performance = Performance::findOrFail($id);
        $employees = Employee::all();
        return view('SuperAdmin.performances.edit', compact('performance', 'employees'));
    }

    // UPDATE (Recalculate Rating)
    public function update(Request $request, $id)
    {
        $performance = Performance::findOrFail($id);

        $validated = $request->validateWithBag('performance', [

            'employee_id' => 'required|exists:employees,id',

            'month' => 'required',

            'attendance_score' => 'required|numeric|min:0|max:100',

            'task_completion_score' => 'required|numeric|min:0|max:100',

            'manager_rating' => 'required|numeric|min:0|max:100',

        ]);

        $rating = round(

            (

                $validated['attendance_score'] +

                $validated['task_completion_score'] +

                $validated['manager_rating']

            ) / 3,

            1

        );

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

        return redirect()
            ->route('performance.index')
            ->with('success', 'Performance updated successfully.');
    }

    // VIEW RATING
    public function show($id)
    {
        $performance = Performance::with('employee')->findOrFail($id);
        return view('SuperAdmin.performances.view', compact('performance'));
    }

    // EXPORT (EXCEL)
    public function export()
    {
        return Excel::download(new PerformanceExport, 'performance.xlsx');
    }
    public function monthlyReport()
    {
        $data = Performance::selectRaw('month, AVG(final_rating) as avg_rating')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('SuperAdmin.performances.monthly_report', compact('data'));
    }
    public function employeeGraph($id)
    {
        $data = Performance::where('employee_id', $id)
            ->orderBy('month')
            ->get();

        return view('SuperAdmin.performances.employee', compact('data'));
    }
}
