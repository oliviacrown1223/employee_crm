<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\SuperAdmin\Salary;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SalaryController  extends Controller
{
    /*public function index()
    {
        $salaries = Salary::with('employee')
            ->latest()
            ->paginate(10);

        return view('hr.salary.index', compact('salaries'));
    }*/
    public function index(Request $request)
    {
        $query = Salary::with('employee');

        if ($request->filled('employee')) {

            $query->whereHas('employee', function ($q) use ($request) {

                $q->where(
                    'name',
                    'LIKE',
                    '%' . $request->employee . '%'
                );

            });
        }


        if ($request->filled('salary_month')) {

            $query->where(
                'salary_month',
                $request->salary_month
            );
        }



        if ($request->filled('payment_status')) {

            $query->where(
                'payment_status',
                $request->payment_status
            );
        }



        /**
         * DEFAULT ALL SALARY
         */
        $salaries = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();



        return view(
            'hr.salary.index',
            compact('salaries')
        );
    }
    public function create()
    {
        $employees = Employee::all();

        return view('hr.salary.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([

            'employee_id' => 'required',

            'basic_salary' => 'required|numeric',

            'bonus' => 'nullable|numeric',

            'deduction' => 'nullable|numeric',

            'salary_month' => 'required',

        ]);

        $netSalary = (
                $request->basic_salary +
                $request->bonus
            ) - $request->deduction;

        Salary::create([

            'employee_id' => $request->employee_id,

            'basic_salary' => $request->basic_salary,

            'bonus' => $request->bonus ?? 0,

            'deduction' => $request->deduction ?? 0,

            'net_salary' => $netSalary,

            'salary_month' => $request->salary_month,

            'payment_status' => $request->payment_status,

        ]);

        return redirect()
            ->route('hr.salary.index')
            ->with('success', 'Salary Generated Successfully');
    }

    public function edit($id)
    {
        $salary = Salary::findOrFail($id);

        $employees = Employee::all();

        return view('hr.salary.edit', compact(
            'salary',
            'employees'
        ));
    }



    public function update(Request $request, $id)
    {
        $salary = Salary::findOrFail($id);

        $netSalary = (
                $request->basic_salary +
                $request->bonus
            ) - $request->deduction;

        $salary->update([

            'employee_id' => $request->employee_id,

            'basic_salary' => $request->basic_salary,

            'bonus' => $request->bonus,

            'deduction' => $request->deduction,

            'net_salary' => $netSalary,

            'salary_month' => $request->salary_month,

            'payment_status' => $request->payment_status,

        ]);

        return redirect()
            ->route('hr.salary.index')
            ->with('success', 'Salary Updated Successfully');
    }

    public function destroy($id)
    {
        Salary::findOrFail($id)->delete();

        return back()->with(
            'success',
            'Salary Deleted Successfully'
        );
    }

        public function show($id)
        {
            $salary = Salary::with('employee')
                ->findOrFail($id);

            return view('hr.salary.show', compact('salary'));
        }

    public function downloadPayslip($id)
    {
        $salary = Salary::with('employee')
            ->findOrFail($id);

        return view('hr.salary.payslip', compact('salary'));
    }



    public function export()
    {
        $salaries = Salary::with('employee')->get();

        return view(
            'hr.salary.export',
            compact('salaries')
        );
    }
}
