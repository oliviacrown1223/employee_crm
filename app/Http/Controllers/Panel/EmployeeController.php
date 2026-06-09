<?php

namespace App\Http\Controllers\Panel;

use App\Exports\EmployeesExport;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('super-admin') || $user->hasRole('hr')) {

            $employees = Employee::latest()->paginate(10);

        } elseif ($user->hasRole('manager')) {

            /*
             * Manager mate team employees.
             * Jo tamara employees table ma manager_id / assigned_user_id hoy
             * to aa line use karo.
             */

            $employees = Employee::latest()
                ->paginate(10);

        } else {

            $employees = Employee::where('user_id', $user->id)
                ->orWhere('email', $user->email)
                ->paginate(10);
        }

        return view('panel.employees.index', compact('employees'));
    }

    public function create()
    {
        if (!auth()->user()->hasAnyRole(['super-admin', 'hr'])) {
            abort(403);
        }

        return view('panel.employees.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->hasAnyRole(['super-admin', 'hr'])) {
            abort(403);
        }

        $request->validate([
            'name'          => 'required|string|max:50|regex:/^[A-Za-z ]+$/',
            'email'         => 'required|email|unique:employees,email',
            'mobile'        => 'required|digits:10|unique:employees,mobile',
            'department'    => 'required|string|max:50',
            'designation'   => 'required|string|max:50',
            'salary'        => 'required|numeric|min:0|max:10000000',
            'joining_date'  => 'required|date|before_or_equal:today',
            'status'        => 'required|in:active,inactive',
            'address'       => 'required|string|max:255',
            'photo'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imageName = null;

        if ($request->hasFile('photo')) {
            $imageName = time() . '.' . $request->photo->extension();
            $request->photo->move(storage_path('app/public'), $imageName);
        }

        Employee::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'mobile'       => $request->mobile,
            'department'   => $request->department,
            'designation'  => $request->designation,
            'salary'       => $request->salary,
            'joining_date' => $request->joining_date,
            'address'      => $request->address,
            'status'       => $request->status,
            'photo'        => $imageName,
        ]);

        return redirect()->route('employees.index')
            ->with('success', 'Employee created successfully');
    }

    public function show(Employee $employee)
    {
        $user = auth()->user();

        if ($user->hasRole('employee')) {
            if ($employee->user_id != $user->id && $employee->email != $user->email) {
                abort(403);
            }
        }

        return view('panel.employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        if (!auth()->user()->hasAnyRole(['super-admin', 'hr'])) {
            abort(403);
        }

        return view('panel.employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        if (!auth()->user()->hasAnyRole(['super-admin', 'hr'])) {
            abort(403);
        }

        $request->validate([
            'name'         => 'required',
            'email'        => 'required|email|unique:employees,email,' . $employee->id,
            'mobile'       => 'required',
            'department'   => 'nullable',
            'designation'  => 'nullable',
            'salary'       => 'nullable',
            'joining_date' => 'nullable|date',
            'address'      => 'nullable',
            'status'       => 'nullable',
            'photo'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imageName = $employee->photo;

        if ($request->hasFile('photo')) {
            $imageName = time() . '.' . $request->photo->extension();
            $request->photo->move(storage_path('app/public'), $imageName);
        }

        $employee->update([
            'name'         => $request->name,
            'email'        => $request->email,
            'mobile'       => $request->mobile,
            'department'   => $request->department,
            'designation'  => $request->designation,
            'salary'       => $request->salary,
            'joining_date' => $request->joining_date,
            'address'      => $request->address,
            'status'       => $request->status,
            'photo'        => $imageName,
        ]);

        return redirect()->route('employees.index')
            ->with('success', 'Employee updated successfully');
    }

    public function destroy(Employee $employee)
    {
        if (!auth()->user()->hasRole('super-admin')) {
            abort(403);
        }

        $employee->delete();

        return redirect()->route('employees.index')
            ->with('success', 'Employee deleted successfully');
    }

    public function export()
    {
        if (!auth()->user()->hasAnyRole(['super-admin', 'hr'])) {
            abort(403);
        }

        return Excel::download(
            new EmployeesExport,
            'employees_' . date('Y-m-d_H-i-s') . '.xlsx'
        );
    }
    public function liveSearch(Request $request)
    {
        $q = trim($request->q);

        if ($q == '') {
            return response()->json([]);
        }

        $results = collect();

        /*
        |--------------------------------------------------------------------------
        | EMPLOYEES
        |--------------------------------------------------------------------------
        */

        $employees = Employee::where(function ($query) use ($q) {

            $query->where('name', 'like', "%{$q}%")
                ->orWhere('email', 'like', "%{$q}%")
                ->orWhere('mobile', 'like', "%{$q}%")
                ->orWhere('department', 'like', "%{$q}%")
                ->orWhere('designation', 'like', "%{$q}%")
                ->orWhere('salary', 'like', "%{$q}%")
                ->orWhere('status', 'like', "%{$q}%")
                ->orWhere('address', 'like', "%{$q}%")
                ->orWhere('joining_date', 'like', "%{$q}%");

        })
            ->limit(10)
            ->get();

        foreach ($employees as $employee) {

            $results->push([

                'title' => $employee->name,

                'subtitle' =>
                    $employee->email .
                    ' | ' .
                    $employee->department .
                    ' | ' .
                    $employee->designation,

                'type' => 'Employee',

                'url' => route('employees.show', $employee->id),

            ]);
        }

        return response()->json($results->values());
    }
}
