<?php

use App\Http\Controllers\SuperAdmin\AttendanceController;
use App\Http\Controllers\SuperAdmin\DailyWorkController;
use App\Http\Controllers\SuperAdmin\EmployeeController;
use App\Http\Controllers\SuperAdmin\LeaveController;
use App\Http\Controllers\SuperAdmin\PerformanceController;
use App\Http\Controllers\SuperAdmin\ProfileController;
use App\Http\Controllers\SuperAdmin\ReportController;
use App\Http\Controllers\SuperAdmin\RoleController;
use App\Http\Controllers\SuperAdmin\SalaryController;
use App\Http\Controllers\SuperAdmin\SettingController;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\SuperAdmin\Salary;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {

    // TOTAL EMPLOYEES
    $totalEmployees = Employee::count();

    // LATEST EMPLOYEES
    $employees = Employee::latest()
        ->take(5)
        ->get();

    // PRESENT TODAY
    $presentToday = Attendance::whereDate(
        'attendance_date',
        Carbon::today()
    )->count();

    // PENDING TASKS
    $pendingTasks = \App\Models\SuperAdmin\DailyWork::where('status', 'pending')->count();

    // TOTAL SALARY THIS MONTH

    $totalSalary = Salary::sum('net_salary');

    return view('SuperAdmin.dashboard', compact(
        'totalEmployees',
        'employees',
        'presentToday',
        'pendingTasks',
        'totalSalary'
    ));

})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'role:super-admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/employees-export',
    [EmployeeController::class, 'export'])
    ->name('employees.export');

Route::resource('employees', EmployeeController::class);

Route::middleware(['auth','role:super-admin'])->group(function () {

    Route::get('/attendance', [AttendanceController::class, 'index'])
        ->name('attendance.index');

    Route::post('/attendance/mark', [AttendanceController::class, 'markAttendance'])
        ->name('attendance.mark');

});
Route::middleware(['auth'])->group(function () {

    // VIEW
    Route::get('/attendance', [AttendanceController::class, 'index'])
        ->name('attendance.index');

    // CREATE
    Route::post('/attendance/mark', [AttendanceController::class, 'markAttendance'])
        ->name('attendance.mark');

    // CHECK IN
    Route::post('/attendance/check-in/{id}', [AttendanceController::class, 'checkIn'])
        ->name('attendance.checkin');

    // CHECK OUT
    Route::post('/attendance/check-out/{id}', [AttendanceController::class, 'checkOut'])
        ->name('attendance.checkout');

    // EDIT
    Route::get('/attendance/edit/{id}', [AttendanceController::class, 'edit'])
        ->name('attendance.edit');

    // UPDATE
    Route::put('/attendance/update/{id}', [AttendanceController::class, 'update'])
        ->name('attendance.update');

    // APPROVE
    Route::post('/attendance/approve/{id}', [AttendanceController::class, 'approve'])
        ->name('attendance.approve');

    Route::get('/attendance/edit/{id}',
        [AttendanceController::class, 'edit'])
        ->name('attendance.edit');

    Route::put('/attendance/update/{id}',
        [AttendanceController::class, 'update'])
        ->name('attendance.update');

});

Route::middleware(['auth'])
    ->prefix('superadmin')
    ->name('superadmin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Salary & Payroll Routes
        |--------------------------------------------------------------------------
        */

        // Salary List
        Route::get('/salaries', [SalaryController::class, 'index'])
            ->name('salaries.index');

        // Create Salary Form
        Route::get('/salaries/create', [SalaryController::class, 'create'])
            ->name('salaries.create');

        // Store Salary
        Route::post('/salaries/store', [SalaryController::class, 'store'])
            ->name('salaries.store');

        // Edit Salary Form
        Route::get('/salaries/{salary}/edit', [SalaryController::class, 'edit'])
            ->name('salaries.edit');

        // Update Salary
        Route::put('/salaries/{salary}/update',
            [SalaryController::class, 'update'])
            ->name('salaries.update');
        // Delete Salary
        Route::delete('/salaries/{salary}/delete', [SalaryController::class, 'destroy'])
            ->name('salaries.destroy');

        // Show Single Salary
        Route::get('/salaries/{salary}', [SalaryController::class, 'show'])
            ->name('salaries.show');

        // Download Payslip
        Route::get('/salary/export',
            [SalaryController::class, 'export'])
            ->name('salary.export');

        Route::get(
            '/salaries/{salary}/payslip',
            [SalaryController::class, 'payslip']
        )->name('salary.payslip');
    });


Route::middleware(['auth'])->group(function () {

    Route::get('/daily-work/search', [DailyWorkController::class, 'search'])
        ->name('daily-work.search');

    Route::get('/daily-work', [DailyWorkController::class, 'index'])->name('daily-work.index');

    Route::get('/daily-work/create', [DailyWorkController::class, 'create'])->name('daily-work.create');
    Route::post('/daily-work/store', [DailyWorkController::class, 'store'])->name('daily-work.store');

    Route::get('/daily-work/edit/{id}', [DailyWorkController::class, 'edit'])->name('daily-work.edit');
    Route::put('/daily-work/update/{id}', [DailyWorkController::class, 'update'])
        ->name('daily-work.update');

    Route::delete('/daily-work/delete/{id}', [DailyWorkController::class, 'destroy'])->name('daily-work.delete');

    Route::post('/daily-work/submit/{id}', [DailyWorkController::class, 'submit'])
        ->name('daily-work.submit');
    // Manager / Admin actions
    Route::post('/daily-work/approve/{id}', [DailyWorkController::class, 'approve'])->name('daily-work.approve');
    Route::post('/daily-work/reject/{id}', [DailyWorkController::class, 'reject'])->name('daily-work.reject');
});

Route::middleware(['auth'])->group(function () {

    Route::resource('performance', PerformanceController::class);
    // EXPORT
    Route::get('performance-export',
        [PerformanceController::class, 'export']
    )->name('performance.export');

    Route::get('performance/employee/{id}/graph',
        [PerformanceController::class, 'employeeGraph']
    )->name('performance.graph');

    Route::get('performance-monthly-report',
        [PerformanceController::class, 'monthlyReport']
    )->name('performance.monthly');

});


Route::middleware(['auth'])->group(function () {

    Route::get('/leave', [LeaveController::class, 'index'])
        ->name('leave.index');

    Route::get('/leave/create', [LeaveController::class, 'create'])
        ->name('leave.create');

    Route::post('/leave/store', [LeaveController::class, 'store'])
        ->name('leave.store');

    Route::get('/leave/edit/{id}', [LeaveController::class, 'edit'])
        ->name('leave.edit');

    Route::put('/leave/update/{id}', [LeaveController::class, 'update'])
        ->name('leave.update');

    Route::post('/leave/approve/{id}', [LeaveController::class, 'approve'])
        ->name('leave.approve');

    Route::post('/leave/reject/{id}', [LeaveController::class, 'reject'])
        ->name('leave.reject');

});



Route::middleware(['auth'])->group(function () {

        Route::get('/reports', [ReportController::class, 'index'])
            ->name('reports.index');

    });

Route::middleware(['auth'])->group(function () {
    Route::get('/settings', [SettingController::class, 'index'])
        ->name('settings.index');

    Route::post('/settings/update', [SettingController::class, 'update'])
        ->name('settings.update');
});

Route::middleware(['auth'])->group(function () {

    Route::resource('roles', RoleController::class);
});

use App\Http\Controllers\AuthController;

Route::post('/admin/change-password', [AuthController::class, 'updatePassword'])
    ->name('admin.password.update');


Route::get('/admin/profile', [AuthController::class, 'profile'])
    ->name('admin.profile');

