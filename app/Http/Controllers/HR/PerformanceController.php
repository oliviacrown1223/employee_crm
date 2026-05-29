<?php

namespace App\Http\Controllers\HR;

use App\Models\SuperAdmin\Performance;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PerformanceExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PerformanceController extends  Controller
{
    // VIEW ALL
    public function index()
    {
        $performances = Performance::with('employee')
            ->latest()
            ->get();

        return view('hr.performance.index', compact('performances'));
    }

    // SINGLE VIEW
    public function show($id)
    {
        $performance = Performance::with('employee')
            ->findOrFail($id);

        return view('hr.performance.show', compact('performance'));
    }

    // MONTHLY REPORT
    public function report()
    {
        $data = Performance::selectRaw(
            'month, AVG(final_rating) as avg_rating'
        )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('hr.performance.report', compact('data'));
    }

    // EMPLOYEE GRAPH
    public function graph($id)
    {
        $data = Performance::where('employee_id', $id)
            ->orderBy('month')
            ->get();

        return view('hr.performance.graph', compact('data'));
    }

    // EXPORT
    public function export()
    {
        return Excel::download(
            new PerformanceExport,
            'hr-performance.xlsx'
        );
    }
}
