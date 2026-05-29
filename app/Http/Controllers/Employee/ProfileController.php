<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

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
        if ($request->status !== null && $request->status !== '') {

            $query->where('status', $request->status);

        }

        // PAGINATION
        $employees = $query->latest()->paginate(9);

        // DEPARTMENT LIST
        $departments = Employee::select('department')
            ->distinct()
            ->pluck('department');

        return view('employee.profile.index', compact(
            'employees',
            'departments'
        ));
    }


    // SINGLE PROFILE SHOW
    public function show($id)
    {
        $employee = Employee::findOrFail($id);

        return view('employee.profile.show', compact('employee'));
    }
}
