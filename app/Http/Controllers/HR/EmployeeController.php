<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::query();

        // SEARCH

        if($request->search)
        {
            $query->where('name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('email', 'LIKE', '%' . $request->search . '%')
                ->orWhere('department', 'LIKE', '%' . $request->search . '%');
        }

        $employees = $query->latest()->paginate(5);

        return view(
            'hr.employees.index',
            compact('employees')
        );
    }

    public function create()
    {
        return view('hr.employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required',

            'email' => 'required|unique:employees',

            'mobile' => 'required',

            'department' => 'required',

            'designation' => 'required',

            'salary' => 'required',

            'joining_date' => 'required',

        ]);

        $imageName = null;

        if($request->photo)
        {
            $imageName = time().'.'.$request->photo->extension();

            $request->photo->move(
                storage_path('app/public'),
                $imageName
            );
        }

        Employee::create([

            'name' => $request->name,

            'email' => $request->email,

            'mobile' => $request->mobile,

            'department' => $request->department,

            'designation' => $request->designation,

            'salary' => $request->salary,

            'joining_date' => $request->joining_date,

            'address' => $request->address,

            'photo' => $imageName

        ]);

        return redirect()
            ->route('hr.employees.index')
            ->with(
                'success',
                'Employee Created Successfully'
            );
    }

    public function show(Employee $employee)
    {
        return view(
            'hr.employees.show',
            compact('employee')
        );
    }

    public function edit(Employee $employee)
    {
        return view(
            'hr.employees.edit',
            compact('employee')
        );
    }

    public function update(Request $request, Employee $employee)
    {
        $imageName = null;

        if($request->photo)
        {
            $imageName = time().'.'.$request->photo->extension();

            $request->photo->move(
                storage_path('app/public'),
                $imageName
            );
        }

        $employee->update([

            'name' => $request->name,

            'email' => $request->email,

            'mobile' => $request->mobile,

            'department' => $request->department,

            'designation' => $request->designation,

            'salary' => $request->salary,

            'joining_date' => $request->joining_date,

            'address' => $request->address,

            'status' => $request->status,

            'photo' => $imageName

        ]);

        return redirect()
            ->route('hr.employees.index')
            ->with(
                'success',
                'Employee Updated Successfully'
            );
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()
            ->route('hr.employees.index')
            ->with(
                'success',
                'Employee Deleted Successfully'
            );
    }

    public function export()
    {
        $employees = Employee::all();

        return response()->streamDownload(function () use ($employees) {

            $file = fopen('php://output', 'w');

            // Header row
            fputcsv($file, ['ID', 'Name', 'Email', 'Department', 'Salary']);

            foreach ($employees as $emp) {
                fputcsv($file, [
                    $emp->id,
                    $emp->name,
                    $emp->email,
                    $emp->department,
                    $emp->salary,
                ]);
            }

            fclose($file);

        }, 'employees.csv', [
            'Content-Type' => 'text/csv',
        ]);
    }
}
