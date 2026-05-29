<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\SuperAdmin\Salary;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class SalaryController extends Controller
{
    // SALARY LIST
    public function index()
    {
        // LOGIN EMPLOYEE
       $employee = Employee::first();

        // SALARIES
        $salaries = Salary::with('employee')
            ->latest()
            ->paginate(10);

        // TOTAL
        $totalSalary = $salaries->sum('net_salary');

        return view(
            'employee.salary.index',
            compact(
                'salaries',
                'totalSalary'
            )
        );
    }


    // SINGLE VIEW
    public function show(Salary $salary)
    {
        return view('employee.salary.show', compact('salary'));
    }




    public function download($id)
    {
        $salary = Salary::with('employee')->findOrFail($id);

        $pdf = Pdf::loadView(
            'employee.salary.pdf',
            compact('salary')
        );

        return $pdf->download('salary-slip.pdf');
    }
}
