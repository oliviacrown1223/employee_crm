<?php

use App\Http\Controllers\Panel\RoleController;

use App\Http\Controllers\Panel\UserController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Panel\DashboardController;
use App\Http\Controllers\Panel\ProfileController;
use App\Http\Controllers\Panel\EmployeeController;
use App\Http\Controllers\Panel\AttendanceController;
use App\Http\Controllers\Panel\SalaryController;
use App\Http\Controllers\Panel\DailyWorkController;
use App\Http\Controllers\Panel\PerformanceController;
use App\Http\Controllers\Panel\LeaveController;
use App\Http\Controllers\Panel\ReportController;


/*
|--------------------------------------------------------------------------
| SINGLE PANEL ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD - all roles
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | PROFILE - all roles
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile.index');

    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])
        ->name('profile.update');

    Route::post('/password/update', [ProfileController::class, 'updatePassword'])
        ->name('password.update');


    /*
    |--------------------------------------------------------------------------
    | EMPLOYEES
    | Super Admin + HR + Manager
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:super-admin|hr|manager|employee'])->group(function () {

        Route::get('/employees', [EmployeeController::class, 'index'])
            ->name('employees.index');

        Route::get('/employees/create', [EmployeeController::class, 'create'])
            ->name('employees.create');

        Route::post('/employees', [EmployeeController::class, 'store'])
            ->name('employees.store');

        Route::get('/employees/{employee}', [EmployeeController::class, 'show'])
            ->name('employees.show');

        Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])
            ->name('employees.edit');

        Route::put('/employees/{employee}', [EmployeeController::class, 'update'])
            ->name('employees.update');

        Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])
            ->name('employees.destroy');

        Route::get('/employees-export', [EmployeeController::class, 'export'])
            ->name('employees.export');
    });


    /*
    |--------------------------------------------------------------------------
    | ATTENDANCE
    | Super Admin + HR + Manager + Employee
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:super-admin|hr|manager|employee'])->group(function () {

        Route::get('/attendance', [AttendanceController::class, 'index'])
            ->name('attendance.index');

        Route::post('/attendance/mark', [AttendanceController::class, 'markAttendance'])
            ->name('attendance.mark');

        Route::post('/attendance/check-in/{id}', [AttendanceController::class, 'checkIn'])
            ->name('attendance.checkin');

        Route::post('/attendance/check-out/{id}', [AttendanceController::class, 'checkOut'])
            ->name('attendance.checkout');

        Route::post('/attendance/approve/{id}', [AttendanceController::class, 'approve'])
            ->name('attendance.approve');

        Route::get('/attendance/edit/{id}', [AttendanceController::class, 'edit'])
            ->name('attendance.edit');

        Route::put('/attendance/update/{id}', [AttendanceController::class, 'update'])
            ->name('attendance.update');
    });


    /*
    |--------------------------------------------------------------------------
    | SALARY
    | Super Admin + HR + Employee
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:super-admin|hr|employee'])->group(function () {

        Route::get('/salary', [SalaryController::class, 'index'])
            ->name('salary.index');

        Route::get('/salary/create', [SalaryController::class, 'create'])
            ->name('salary.create');

        Route::post('/salary', [SalaryController::class, 'store'])
            ->name('salary.store');

        Route::get('/salary/{salary}', [SalaryController::class, 'show'])
            ->name('salary.show');

        Route::get('/salary/{salary}/edit', [SalaryController::class, 'edit'])
            ->name('salary.edit');

        Route::put('/salary/{salary}', [SalaryController::class, 'update'])
            ->name('salary.update');

        Route::delete('/salary/{salary}', [SalaryController::class, 'destroy'])
            ->name('salary.destroy');

        Route::get('/salary-export', [SalaryController::class, 'export'])
            ->name('salary.export');

        Route::get('/salary/{salary}/payslip',
            [SalaryController::class, 'payslip'])
            ->name('salary.payslip');

    });


    /*
    |--------------------------------------------------------------------------
    | DAILY WORK / TASKS
    | Super Admin + Manager + Employee
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:super-admin|manager|employee'])->group(function () {

        Route::get('/daily-work/search', [DailyWorkController::class, 'search'])
            ->name('daily-work.search');

        Route::get('/daily-work', [DailyWorkController::class, 'index'])
            ->name('daily-work.index');

        Route::get('/daily-work/create', [DailyWorkController::class, 'create'])
            ->name('daily-work.create');

        Route::post('/daily-work/store', [DailyWorkController::class, 'store'])
            ->name('daily-work.store');

        Route::get('/daily-work/edit/{id}', [DailyWorkController::class, 'edit'])
            ->name('daily-work.edit');

        Route::put('/daily-work/update/{id}', [DailyWorkController::class, 'update'])
            ->name('daily-work.update');

        Route::delete('/daily-work/delete/{id}', [DailyWorkController::class, 'destroy'])
            ->name('daily-work.destroy');

        Route::post('/daily-work/submit/{id}', [DailyWorkController::class, 'submit'])
            ->name('daily-work.submit');

        Route::post('/daily-work/approve/{id}', [DailyWorkController::class, 'approve'])
            ->name('daily-work.approve');

        Route::post('/daily-work/reject/{id}', [DailyWorkController::class, 'reject'])
            ->name('daily-work.reject');
    });


    /*
    |--------------------------------------------------------------------------
    | PERFORMANCE
    | Super Admin + HR + Manager + Employee
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:super-admin|hr|manager|employee'])->group(function () {

        Route::get('/performance', [PerformanceController::class, 'index'])
            ->name('performance.index');

        Route::get('/performance/create', [PerformanceController::class, 'create'])
            ->name('performance.create');

        Route::post('/performance', [PerformanceController::class, 'store'])
            ->name('performance.store');

        Route::get('/performance/{id}', [PerformanceController::class, 'show'])
            ->name('performance.show');

        Route::get('/performance/{id}/edit', [PerformanceController::class, 'edit'])
            ->name('performance.edit');

        Route::put('/performance/{id}', [PerformanceController::class, 'update'])
            ->name('performance.update');

        Route::get('/performance-export', [PerformanceController::class, 'export'])
            ->name('performance.export');

        Route::get('/performance-monthly-report', [PerformanceController::class, 'monthlyReport'])
            ->name('performance.monthly');

        Route::get('/performance/employee/{id}/graph', [PerformanceController::class, 'employeeGraph'])
            ->name('performance.graph');

        Route::post(
            '/performance/{id}/self-rating',
            [PerformanceController::class, 'selfRating']
        )->name('performance.self.rating');
    });


    /*
    |--------------------------------------------------------------------------
    | LEAVE
    | Super Admin + HR + Employee
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:super-admin|hr|employee'])->group(function () {

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

        Route::delete('/leave/delete/{id}', [LeaveController::class, 'destroy'])
            ->name('leave.destroy');

        Route::post('/leave/approve/{id}', [LeaveController::class, 'approve'])
            ->name('leave.approve');

        Route::post('/leave/reject/{id}', [LeaveController::class, 'reject'])
            ->name('leave.reject');
    });


    /*
    |--------------------------------------------------------------------------
    | REPORTS
    | Super Admin + HR + Manager
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:super-admin|hr|manager'])->group(function () {

        Route::get('/reports', [ReportController::class, 'index'])
            ->name('reports.index');

    });


    Route::get('/reports/export/excel',
        [ReportController::class,'exportExcel'])
        ->name('reports.export.excell');

    Route::get('/reports/export/pdf',
        [ReportController::class,'exportPdf'])
        ->name('reports.export.pdff');

    /*
    |--------------------------------------------------------------------------
    | USERS + ROLES
    | Super Admin only
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:super-admin'])->group(function () {

        Route::resource('users', UserController::class);

        Route::resource('roles', RoleController::class);
    });

    /*
      |--------------------------------------------------------------------------
      | Profile
      | Super Admin + HR + Manager + Employee
      |--------------------------------------------------------------------------
      */
    Route::middleware('auth')->group(function () {

        Route::get('/profile',
            [ProfileController::class,'index'])
            ->name('profile.index');

        Route::post('/profile/update',
            [ProfileController::class,'updateProfile'])
            ->name('profile.update');

        Route::post('/password/update',
            [ProfileController::class,'updatePassword'])
            ->name('password.update');

    });

});
