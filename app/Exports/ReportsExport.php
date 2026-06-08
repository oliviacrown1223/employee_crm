<?php

namespace App\Exports;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\SuperAdmin\DailyWork;
use App\Models\SuperAdmin\Leave;
use App\Models\SuperAdmin\Performance;
use App\Models\SuperAdmin\Salary;
use Maatwebsite\Excel\Concerns\FromArray;

class ReportsExport implements FromArray
{
    public function array(): array
    {
        return [

            [
                'Employees',
                Employee::count()
            ],

            [
                'Attendance',
                Attendance::count()
            ],

            [
                'Salary',
                Salary::sum('net_salary')
            ],

            [
                'Daily Work',
                DailyWork::count()
            ],

            [
                'Performance',
                Performance::count()
            ],

            [
                'Leaves',
                Leave::count()
            ]

        ];
    }
}
