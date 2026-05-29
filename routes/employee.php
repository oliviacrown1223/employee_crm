<?php

use App\Http\Controllers\Employee\AttendanceController;
use App\Http\Controllers\Employee\DashboardController;
use App\Http\Controllers\Employee\EmployeeLeaveController;
use App\Http\Controllers\Employee\PerformanceController;
use App\Http\Controllers\Employee\ProfileController;

Route::prefix('employee')->middleware(['auth'])->group(function () {

    Route::get('/daily-work', [\App\Http\Controllers\Employee\DailyWorkController::class, 'index'])
        ->name('employee.daily-work.index');

    Route::post('/daily-work/store', [\App\Http\Controllers\Employee\DailyWorkController::class, 'store'])
        ->name('employee.daily-work.store');

    Route::post('/daily-work/submit/{id}',
        [\App\Http\Controllers\Employee\DailyWorkController::class, 'submit'])
        ->name('employee.daily-work.submit');

});

Route::middleware(['auth'])->prefix('employee')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('employee.dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('employee.profile');

    Route::get('/profile/{id}',
        [ProfileController::class, 'show'])
        ->name('employee.profile.show');

    // Salary
    Route::get('/salary', [SalaryController::class, 'index'])->name('employee.salary');
});

Route::middleware(['auth'])->prefix('employee')->group(function () {

    // Employee Dashboard Performance
    Route::get('/performance', [PerformanceController::class, 'index'])
        ->name('employee.performance.index');

    // View single performance
    Route::get('/performance/{id}', [PerformanceController::class, 'show'])
        ->name('employee.performance.show');

    // Self rating update
    Route::post('/performance/{id}/self-rating', [PerformanceController::class, 'selfRating'])
        ->name('employee.performance.self');
});


Route::middleware(['auth'])->prefix('employee')->group(function () {

    Route::get('/leave', [EmployeeLeaveController::class, 'index'])
        ->name('employee.leave.index');

    Route::get('/leave/create', [EmployeeLeaveController::class, 'create'])
        ->name('employee.leave.create');

    Route::post('/leave/store', [EmployeeLeaveController::class, 'store'])
        ->name('employee.leave.store');

    Route::get('/leave/edit/{id}', [EmployeeLeaveController::class, 'edit'])
        ->name('employee.leave.edit');

    Route::put('/leave/update/{id}', [EmployeeLeaveController::class, 'update'])
        ->name('employee.leave.update');

    Route::delete('/leave/delete/{id}', [EmployeeLeaveController::class, 'destroy'])
        ->name('employee-leave.destroy');

});
Route::prefix('employee')
    ->middleware(['auth'])
    ->group(function () {

        Route::get('/attendance',
            [App\Http\Controllers\Employee\AttendanceController::class, 'index']
        )->name('employee.attendance');

        Route::post('/attendance/check-in',
            [App\Http\Controllers\Employee\AttendanceController::class, 'checkIn']
        )->name('employee.attendance.checkin');

        Route::post('/attendance/check-out',
            [App\Http\Controllers\Employee\AttendanceController::class, 'checkOut']
        )->name('employee.attendance.checkout');

    });
use App\Http\Controllers\Employee\SalaryController;


Route::prefix('employee')
    ->middleware(['auth'])
    ->group(function () {

        Route::get('/salary',
            [SalaryController::class, 'index'])
            ->name('employee.salary.index');

        Route::get('/salary/{salary}',
            [SalaryController::class, 'show'])
            ->name('employee.salary.show');

        Route::get('/employee/salary/download/{id}',
            [SalaryController::class, 'download'])
            ->name('employee.salary.download');

    });
