<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\SuperAdmin\DailyWork;
use App\Models\SuperAdmin\Leave;
use App\Models\SuperAdmin\Performance;
use App\Models\SuperAdmin\Salary;
use App\Models\User;
use App\Exports\ReportsExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | SUPER ADMIN
        |--------------------------------------------------------------------------
        */
        if ($user->hasRole('super-admin')) {

            $attendances = Attendance::with('employee')
                ->latest()
                ->get();
            $employees = Employee::count();

            $attendance = Attendance::count();

            $salaries = Salary::all();
            $salary = Salary::whereIn('id', $salaries->pluck('id'))
                ->where('payment_status', 'Paid')
                ->sum('net_salary');

            $dailyWorks = DailyWork::count();

            $performances = Performance::count();

            $leaves = Leave::count();

            $reportTitle = 'All System Reports';
        }

        /*
        |--------------------------------------------------------------------------
        | HR → Employee Reports
        |--------------------------------------------------------------------------
        */
        elseif ($user->hasRole('hr')) {
            $attendances = Attendance::with('employee')
                ->latest()
                ->get();
            $employees = Employee::count();

            $attendance = Attendance::count();

            $salaries = Salary::all();
            $salary = Salary::whereIn('id', $salaries->pluck('id'))
                ->where('payment_status', 'Paid')
                ->sum('net_salary');

            $dailyWorks = DailyWork::count();

            $performances = Performance::count();

            $leaves = Leave::count();

            $reportTitle = 'Employee Reports';
        }

        /*
        |--------------------------------------------------------------------------
        | MANAGER → Team Reports
        |--------------------------------------------------------------------------
        */
        elseif ($user->hasRole('manager')) {
            $attendances = Attendance::with('employee')
                ->latest()
                ->get();
            $employees = Employee::count();

            $attendance = Attendance::count();

            $salaries = Salary::all();
            $salary = Salary::whereIn('id', $salaries->pluck('id'))
                ->where('payment_status', 'Paid')
                ->sum('net_salary');

            $dailyWorks = DailyWork::count();

            $performances = Performance::count();

            $leaves = Leave::count();

            $reportTitle = 'All System Reports';
        }

        else {

            abort(403);

        }

        return view(
            'panel.reports.index',
            compact(
                'employees',
                'attendances',
                'attendance',
                'salary',
                'dailyWorks',
                'performances',
                'leaves',
                'reportTitle'
            )
        );
    }
    public function exportExcel()
    {
        return Excel::download(
            new ReportsExport,
            'reports.xlsx'
        );
    }


    public function exportPdf()
    {
        $data = [

            'employees' => Employee::count(),

            'attendance' => Attendance::count(),

            'salary' => Salary::sum('net_salary'),

            'dailyWorks' => DailyWork::count(),

            'performances' => Performance::count(),

            'leaves' => Leave::count(),

        ];

        $pdf = Pdf::loadView(
            'panel.reports.pdf',
            $data
        );

        return $pdf->download('reports.pdf');
    }
}
