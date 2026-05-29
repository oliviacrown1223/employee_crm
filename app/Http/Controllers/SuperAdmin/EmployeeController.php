<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\SuperAdmin\DailyWork;
use App\Models\SuperAdmin\Salary;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Employee::query();

        $totalSalary = Salary::sum('net_salary');

        $pendingTasks = DailyWork::where('status', 'pending')->count();
        // SEARCH

        if($request->search)
        {

            $query->where('name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('email', 'LIKE', '%' . $request->search . '%')
                ->orWhere('department', 'LIKE', '%' . $request->search . '%');

        }
        $today = Carbon::today()->toDateString();
        $presentToday = Attendance::whereDate('attendance_date', $today)
            ->where('status', 'present')
            ->count();
        // PAGINATION

        $employees = $query->latest()->paginate(5);



        return view('SuperAdmin.employees.index', compact(
            'employees',
            'pendingTasks',
            'totalSalary',
            'presentToday',

        ));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('SuperAdmin.employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'name' => ['required', 'string', 'max:100'],

            'email' => ['required', 'email', 'unique:employees,email'],

            'mobile' => ['required', 'digits:10'],

            'department' => ['required', 'string'],

            'designation' => ['required', 'string'],

            'salary' => ['required', 'numeric', 'min:0'],

            'joining_date' => ['required', 'date'],

            'address' => ['nullable', 'string', 'max:255'],

            'status' => ['required', 'in:0,1'],

            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],

        ], [

            // CUSTOM MESSAGES
            'name.required' => 'Employee name is required',

            'email.required' => 'Email is required',
            'email.email' => 'Enter valid email format',
            'email.unique' => 'This email already exists',

            'mobile.required' => 'Mobile number is required',
            'mobile.digits_between' => 'Mobile must be 10 to 15 digits',

            'salary.numeric' => 'Salary must be number',

            'joining_date.date' => 'Enter valid date',

            'photo.image' => 'Photo must be image',
            'photo.mimes' => 'Only jpg, jpeg, png allowed',

        ]);

        // ❌ FAIL RESPONSE (AJAX)
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ]);
        }

        // IMAGE UPLOAD
        $imageName = null;

        if ($request->hasFile('photo')) {
            $imageName = time().'.'.$request->photo->extension();

            $request->photo->move(storage_path('app/public'), $imageName);
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
            'status' => $request->status,
            'photo' => $imageName
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Employee Created Successfully',
            'redirect' => route('employees.index')
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return view('SuperAdmin.employees.show',
            compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return view('SuperAdmin.employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([

            'name' => 'required',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'mobile' => 'required',
            'department' => 'required',
            'designation' => 'required',
            'salary' => 'required',
            'joining_date' => 'required',
            'address' => 'required',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

        ]);

        // KEEP OLD IMAGE
        $imageName = $employee->photo;

        // NEW IMAGE UPLOAD
        if ($request->hasFile('photo')) {

            $image = $request->file('photo');

            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $image->move(storage_path('app/public'), $imageName);
        }

        // UPDATE
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
            ->route('employees.index')
            ->with('success', 'Employee Updated Successfully');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')
            ->with('success', 'Employee Deleted Successfully');
    }
    public function export()
    {
        $employees = Employee::all();

        $filename = "employees_" . date('Y-m-d_H-i-s') . ".csv";

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
        ];

        $callback = function () use ($employees) {

            $file = fopen('php://output', 'w');

            // COLUMN HEADERS
            fputcsv($file, [
                'ID',
                'Name',
                'Email',
                'Mobile',
                'Department',
                'Designation',
                'Salary',
                'Joining Date',
                'Address',
                'Status',
                'Photo',
                'Created At',
                'Updated At'
            ]);

            foreach ($employees as $employee) {

                fputcsv($file, [

                    $employee->id,
                    $employee->name,
                    $employee->email,

                    // MOBILE FIX (Excel safe)
                    $employee->mobile ? "'" . $employee->mobile : '',

                    $employee->department,
                    $employee->designation,
                    $employee->salary,

                    // DATE FIX (no ##### issue)

                    $employee->joining_date
                        ? "'" . Carbon::parse($employee->joining_date)->format('d-m-Y')
                        : '',

                    $employee->address,
                    $employee->status,
                    $employee->photo,


                    $employee->created_at
                        ? "'" . Carbon::parse($employee->created_at)->format('d-m-Y')
                        : '',

                    $employee->updated_at
                        ? "'" . Carbon::parse($employee->updated_at)->format('d-m-Y')
                        : ''
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}
