<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class TeamEmployeeController extends Controller
{
    // EMPLOYEE LIST
    public function index(Request $request)
    {
        $query = Employee::query();

        // SEARCH
        if ($request->search) {

            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');

        }

        // DEPARTMENT FILTER
        if ($request->department) {

            $query->where('department', $request->department);

        }

        // STATUS FILTER
        if ($request->status !== null &&
            $request->status !== '') {

            $query->where('status', $request->status);

        }

        // EMPLOYEE LIST
        $employees = $query->latest()->paginate(9);

        // DEPARTMENTS
        $departments = Employee::select('department')
            ->distinct()
            ->pluck('department');

        return view(
            'manager.team.index',
            compact('employees', 'departments')
        );
    }


    // SINGLE EMPLOYEE PROFILE
    public function show($id)
    {
        $employee = Employee::findOrFail($id);

        return view(
            'manager.team.show',
            compact('employee')
        );
    }
    // EDIT PAGE
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);

        return view(
            'manager.team.edit',
            compact('employee')
        );
    }


    // UPDATE EMPLOYEE
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        // VALIDATION
        $request->validate([

            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'nullable',
            'department' => 'required',
            'designation' => 'required',
            'salary' => 'required',
            'status' => 'required',

        ]);

        // IMAGE UPDATE
        if ($request->hasFile('photo')) {

            $image = time() . '.' .
                $request->photo->extension();

            $request->photo->storeAs(
                '',
                $image,
                'public'
            );

            $employee->photo = $image;
        }

        // UPDATE DATA
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->mobile = $request->mobile;
        $employee->department = $request->department;
        $employee->designation = $request->designation;
        $employee->salary = $request->salary;
        $employee->status = $request->status;

        $employee->save();

        return redirect()
            ->route('manager.team.index')
            ->with('success',
                'Employee Updated Successfully');
    }
}
