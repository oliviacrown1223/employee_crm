<?php

use App\Http\Controllers\HR\HRLeaveController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HR\PerformanceController;
use App\Http\Controllers\HR\ReportController as HRReportController;

Route::middleware(['auth'])
    ->prefix('hr')
    ->group(function () {

        // All Performance
        Route::get('/performance',
            [PerformanceController::class, 'index']
        )->name('hr.performance.index');

        // View
        Route::get('/performance/{id}',
            [PerformanceController::class, 'show']
        )->name('hr.performance.showw');

        // Monthly Report
        Route::get('/performance-report',
            [PerformanceController::class, 'report']
        )->name('hr.performance.report');

        // KPI Graph
        Route::get('/performance-graph/{id}',
            [PerformanceController::class, 'graph']
        )->name('hr.performance.graph');

        // Export
        Route::get('/performance-export',
            [PerformanceController::class, 'export']
        )->name('hr.performance.export');

    });


Route::middleware(['auth'])->prefix('hr')->group(function () {

    Route::get('/leave', [HRLeaveController::class, 'index'])
        ->name('hr.leave.index');

    Route::post('/leave/approve/{id}', [HRLeaveController::class, 'approve'])
        ->name('hr.leave.approve');

    Route::post('/leave/reject/{id}', [HRLeaveController::class, 'reject'])
        ->name('hr.leave.reject');

});
Route::prefix('hr')
    ->middleware(['auth'])
    ->group(function () {

        Route::get('/reports', [HRReportController::class, 'index'])
            ->name('hr.reports.index');

    });

use App\Http\Controllers\HR\AttendanceController;

Route::prefix('hr')
    ->middleware(['auth'])
    ->group(function () {

        Route::get('/attendance', [AttendanceController::class, 'index'])
            ->name('hr.attendance.index');

        Route::post('/attendance/mark', [AttendanceController::class, 'markAttendance'])
            ->name('hr.attendance.mark');

        Route::post('/attendance/check-in/{id}', [AttendanceController::class, 'checkIn'])
            ->name('hr.attendance.checkin');

        Route::post('/attendance/check-out/{id}', [AttendanceController::class, 'checkOut'])
            ->name('hr.attendance.checkout');

        Route::post('/attendance/approve/{id}', [AttendanceController::class, 'approve'])
            ->name('hr.attendance.approve');

        Route::get('/attendance/edit/{id}', [AttendanceController::class, 'edit'])
            ->name('hr.attendance.edit');

        Route::put('/attendance/update/{id}', [AttendanceController::class, 'update'])
            ->name('hr.attendance.update');

    });

use App\Http\Controllers\HR\DashboardController;
use App\Http\Controllers\HR\EmployeeController;
use App\Http\Controllers\HR\SalaryController;

Route::middleware(['auth'])
    ->prefix('hr')
    ->name('hr.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');


    });



Route::middleware(['auth'])
    ->prefix('hr')
    ->name('hr.')
    ->group(function () {

        Route::resource('employees', EmployeeController::class);

    });


Route::middleware(['auth'])
    ->prefix('hr')
    ->name('hr.')
    ->group(function () {

        // EXPORT
        Route::get(
            'salary/export',
            [SalaryController::class, 'export']
        )->name('salary.export');



        // DOWNLOAD
        Route::get(
            'salary/{salary}/download',
            [SalaryController::class, 'downloadPayslip']
        )->name('salary.download');



        // EMPLOYEE EXPORT
        Route::get(
            'employees-export',
            [EmployeeController::class, 'export']
        )->name('employees.export');



        // RESOURCE
        Route::resource('salary', SalaryController::class);

    });
