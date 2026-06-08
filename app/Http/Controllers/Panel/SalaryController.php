<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\SuperAdmin\Salary;
use Illuminate\Http\Request;
use App\Exports\SalaryExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class SalaryController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $query = Salary::with('employee');

        if ($user->hasRole('employee')) {
            $employee = Employee::where('user_id', $user->id)
                ->orWhere('email', $user->email)
                ->first();

            if ($employee) {
                $query->where('employee_id', $employee->id);
            } else {
                $query->whereRaw('1 = 0');
            }
        }

        if ($request->search) {
            $search = $request->search;

            $query->whereHas('employee', function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%");
            });
        }

        if ($request->month) {
            $query->where('salary_month', $request->month);
        }

        $salaries = $query->latest()->get();

        if ($request->ajax()) {
            return view('panel.salary.table', compact('salaries'))->render();
        }

        $totalSalary = (clone $query)->sum('net_salary');

        $totalPaid = Salary::whereIn('id', $salaries->pluck('id'))
            ->where('payment_status', 'Paid')
            ->sum('net_salary');

        $totalPending = Salary::whereIn('id', $salaries->pluck('id'))
            ->where('payment_status', 'Pending')
            ->sum('net_salary');

        return view('panel.salary.index', compact(
            'salaries',
            'totalSalary',
            'totalPaid',
            'totalPending'
        ));
    }

    public function create()
    {
        if (!auth()->user()->hasAnyRole(['super-admin', 'hr'])) {
            abort(403);
        }

        $employees = Employee::all();

        return view('panel.salary.create', compact('employees'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->hasAnyRole(['super-admin', 'hr'])) {
            abort(403);
        }

        $request->validateWithBag('salary', [
            'employee_id' => 'required|exists:employees,id',
            'salary_month' => 'required|date_format:Y-m',
            'basic_salary' => 'required|numeric|min:0',
            'bonus' => 'nullable|numeric|min:0',
            'deduction' => 'nullable|numeric|min:0',
            'payment_status' => 'required|in:Pending,Paid',
        ]);

        $bonus = $request->bonus ?? 0;
        $deduction = $request->deduction ?? 0;
        $netSalary = ($request->basic_salary + $bonus) - $deduction;

        Salary::create([
            'employee_id' => $request->employee_id,
            'basic_salary' => $request->basic_salary,
            'bonus' => $bonus,
            'deduction' => $deduction,
            'net_salary' => $netSalary,
            'payment_status' => $request->payment_status,
            'salary_month' => $request->salary_month,
        ]);

        return redirect()->route('salary.index')
            ->with('success', 'Salary generated successfully');
    }

    public function show(Salary $salary)
    {
        $this->checkSalaryAccess($salary);

        return view('panel.salary.show', compact('salary'));
    }

    public function edit(Salary $salary)
    {
        if (!auth()->user()->hasAnyRole(['super-admin', 'hr'])) {
            abort(403);
        }

        $employees = Employee::all();

        return view('panel.salary.edit', compact('salary', 'employees'));
    }

    public function update(Request $request, Salary $salary)
    {
        if (!auth()->user()->hasAnyRole(['super-admin', 'hr'])) {
            abort(403);
        }

        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'basic_salary' => 'required|numeric|min:0',
            'bonus' => 'nullable|numeric|min:0',
            'deduction' => 'nullable|numeric|min:0',
            'salary_month' => 'required|date_format:Y-m',
            'payment_status' => 'required|in:Pending,Paid',
        ]);

        $bonus = $request->bonus ?? 0;
        $deduction = $request->deduction ?? 0;
        $netSalary = ($request->basic_salary + $bonus) - $deduction;

        $salary->update([
            'employee_id' => $request->employee_id,
            'basic_salary' => $request->basic_salary,
            'bonus' => $bonus,
            'deduction' => $deduction,
            'net_salary' => $netSalary,
            'payment_status' => $request->payment_status,
            'salary_month' => $request->salary_month,
        ]);

        return redirect()->route('salary.index')
            ->with('success', 'Salary updated successfully');
    }

    public function destroy(Salary $salary)
    {
        if (!auth()->user()->hasRole('super-admin')) {
            abort(403);
        }

        $salary->delete();

        return redirect()->route('salary.index')
            ->with('success', 'Salary deleted successfully');
    }

    public function export()
    {
        if (!auth()->user()->hasAnyRole(['super-admin', 'hr'])) {
            abort(403);
        }

        return Excel::download(new SalaryExport, 'salary.xlsx');
    }

    public function payslip(Salary $salary)
    {
        $this->checkSalaryAccess($salary);

        $pdf = Pdf::loadView('panel.salary.payslip', compact('salary'));

        return $pdf->download('payslip.pdf');
    }

    private function checkSalaryAccess(Salary $salary)
    {
        $user = auth()->user();

        if ($user->hasAnyRole(['super-admin', 'hr'])) {
            return true;
        }

        if ($user->hasRole('employee')) {
            $employee = Employee::where('user_id', $user->id)
                ->orWhere('email', $user->email)
                ->first();

            if ($employee && $salary->employee_id == $employee->id) {
                return true;
            }
        }

        abort(403);
    }
}
