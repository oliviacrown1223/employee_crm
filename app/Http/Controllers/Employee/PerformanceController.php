<?php

namespace App\Http\Controllers\Employee;

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
    return view('employee.performances.index', compact('performances'));
}

    // Single performance
    public function show($id)
    {
        $performance = Performance::with('employee')->findOrFail($id);

        return view('employee.performances.show', compact('performance'));
    }

    // Self Rating
    public function selfRating(Request $request, $id)
    {

        $request->validate([
            'self_rating' => 'required|numeric|min:1|max:5'
        ]);
        $performance = Performance::with('employee')->findOrFail($id);

        $performance->update([
            'self_rating' => $request->self_rating
        ]);

        return redirect()
            ->route('employee.performance.index')
            ->with('success', 'Self Rating Submitted Successfully');
    }
}
