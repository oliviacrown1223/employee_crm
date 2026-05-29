<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\SuperAdmin\DailyWork;
use App\Models\SuperAdmin\Performance;

class ReportController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | TEAM ATTENDANCE
        |--------------------------------------------------------------------------
        */

        $attendance = Attendance::count();

        $presentEmployees = Attendance::whereDate(
            'attendance_date',
            today()
        )
            ->where('status', 'present')
            ->count();



        /*
        |--------------------------------------------------------------------------
        | DAILY WORK
        |--------------------------------------------------------------------------
        */

        $dailyWorks = DailyWork::count();

        $pendingWorks = DailyWork::where(
            'status',
            'Pending'
        )->count();



        /*
        |--------------------------------------------------------------------------
        | PERFORMANCE
        |--------------------------------------------------------------------------
        */

        $performances = Performance::count();

        $averageRating = Performance::avg(
            'final_rating'
        );



        return view(
            'manager.reports.index',
            compact(
                'attendance',
                'presentEmployees',
                'dailyWorks',
                'pendingWorks',
                'performances',
                'averageRating'
            )
        );
    }
}

