<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\SuperAdmin\Salary;
use Illuminate\Http\Request;
use App\Exports\SalaryExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;


class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Salary::with('employee');

        // SEARCH
        if($request->search)
        {
            $search = $request->search;

            $query->whereHas('employee', function($q) use ($search){

                $q->where('name', 'LIKE', "%{$search}%");

            });
        }

        // MONTH FILTER
        if($request->month)
        {
            $query->where('salary_month', $request->month);
        }


        $salaries = $query
            ->latest()
            ->get();
        // AJAX RESPONSE
        if($request->ajax())
        {
            return view('SuperAdmin.salary.table', compact('salaries'))->render();
        }

        // SUMMARY
        $totalSalary = Salary::sum('net_salary');

        $totalPaid = Salary::where(
            'payment_status',
            'Paid'
        )->sum('net_salary');

        $totalPending = Salary::where(
            'payment_status',
            'Pending'
        )->sum('net_salary');

        return view('SuperAdmin.salary.index', compact(
            'salaries',
            'totalSalary',
            'totalPaid',
            'totalPending'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();

        return view('SuperAdmin.salary.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validateWithBag('salary', [

            'employee_id' => 'required|exists:employees,id',

            'salary_month' => 'required|date_format:Y-m',

            'basic_salary' => 'required|numeric|min:0',

            'bonus' => 'nullable|numeric|min:0',

            'deduction' => 'nullable|numeric|min:0',

            'payment_status' => 'required|in:Pending,Paid',

        ]);

        $netSalary = (
                $request->basic_salary +
                ($request->bonus ?? 0)
            ) - ($request->deduction ?? 0);

        Salary::create([

            'employee_id' => $request->employee_id,

            'basic_salary' => $request->basic_salary,

            'bonus' => $request->bonus ?? 0,

            'deduction' => $request->deduction ?? 0,

            'net_salary' => $netSalary,

            'payment_status' => $request->payment_status,

            'salary_month' => $request->salary_month,

        ]);

        return redirect()
            ->route('superadmin.salaries.index')
            ->with('success', 'Salary Generated Successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(Salary $salary)
    {
        return view('SuperAdmin.salary.show', compact('salary'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Salary $salary)
    {
        $employees = Employee::all();

        return view('SuperAdmin.salary.edit', compact(
            'salary',
            'employees'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Salary $salary)
    {
        $request->validate([

            'employee_id' => 'required',
            'basic_salary' => 'required|numeric',
            'salary_month' => 'required',

        ]);

        $bonus = $request->bonus ?? 0;

        $deduction = $request->deduction ?? 0;

        $netSalary = (
                $request->basic_salary + $bonus
            ) - $deduction;

        $salary->update([

            'employee_id' => $request->employee_id,

            'basic_salary' => $request->basic_salary,

            'bonus' => $bonus,

            'deduction' => $deduction,

            'net_salary' => $netSalary,

            'payment_status' => $request->payment_status,

            'salary_month' => $request->salary_month,

        ]);

        return redirect()
            ->route('superadmin.salaries.index')
            ->with('success', 'Salary Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salary $salary)
    {
        $salary->delete();

        return redirect()
            ->route('superadmin.salaries.index')
            ->with('success', 'Salary Deleted Successfully');
    }


        public function export()
    {
        return Excel::download(
            new SalaryExport,
            'salary.xlsx'
        );
    }


    // PDF PAYSLIP
    public function payslip(Salary $salary)
    {
        $pdf = Pdf::loadView(
            'SuperAdmin.salary.payslip',
            compact('salary')
        );

        return $pdf->download('payslip.pdf');
    }
}
