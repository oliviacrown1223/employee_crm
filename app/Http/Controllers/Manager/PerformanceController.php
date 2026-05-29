<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\SuperAdmin\Performance;
use Illuminate\Http\Request;

class PerformanceController extends Controller
{
    // TEAM PERFORMANCE LIST
    public function index()
    {
        $performances = Performance::with('employee')->latest()->get();

        return view('manager.performance.index', compact('performances'));
    }

    // VIEW TEAM MEMBER
    public function show($id)
    {
        $performance = Performance::where('id', $id)
            ->whereHas('employee', function ($q) {

                $q->where('manager_id', auth()->id());

            })
            ->with('employee')
            ->firstOrFail();

        return view('manager.performance.edit', compact('performance'));
    }

    // EDIT RATING
    public function edit($id)
    {
        $performance = Performance::findOrFail($id);

        return view('manager.performance.edit', compact('performance'));
    }

    // UPDATE MANAGER RATING
    public function update(Request $request, $id)
    {
        $request->validate([
            'manager_rating' => 'required|numeric|min:1|max:5'
        ]);

        $performance = Performance::findOrFail($id);

        // FINAL KPI
        $final = round(
            (
                $performance->attendance_score +
                $performance->task_completion_score +
                $request->manager_rating
            ) / 3,1
        );
        $final = min($final, 5);
        $performance->update([
            'manager_rating' => $request->manager_rating,
            'final_rating' => $final
        ]);

        return redirect()
            ->route('manager.performance.index')
            ->with('success', 'Manager Rating Updated');
    }
}
