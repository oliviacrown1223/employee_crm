<?php

use App\Http\Controllers\Manager\AttendanceController;
use App\Http\Controllers\Manager\PerformanceController;
use App\Http\Controllers\Manager\ReportController as ManagerReportController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])
    ->prefix('manager')
    ->group(function () {

        Route::get('/performance',
            [PerformanceController::class, 'index']
        )->name('manager.performance.index');

        Route::get('/performance/{id}',
            [PerformanceController::class, 'show']
        )->name('manager.performance.show');

        Route::get('/performance/{id}/edit',
            [PerformanceController::class, 'edit']
        )->name('manager.performance.edit');

        Route::post('/performance/{id}/update',
            [PerformanceController::class, 'update']
        )->name('manager.performance.update');

    });

Route::prefix('manager')
    ->middleware(['auth'])
    ->group(function () {

        Route::get('/reports',
            [ManagerReportController::class, 'index'])
            ->name('manager.reports.index');

    });

Route::prefix('manager')
    ->middleware(['auth'])
    ->group(function () {

        Route::get('/attendance',
            [AttendanceController::class, 'index']
        )->name('manager.attendance');

        Route::post('/attendance/check-in/{id}',
            [AttendanceController::class, 'checkIn']
        )->name('manager.attendance.checkin');

        Route::post('/attendance/check-out/{id}',
            [AttendanceController::class, 'checkOut']
        )->name('manager.attendance.checkout');

        Route::post('/attendance/approve/{id}',
            [AttendanceController::class, 'approve']
        )->name('manager.attendance.approve');

    });
use App\Http\Controllers\Manager\TeamEmployeeController;



Route::prefix('manager')
    ->middleware(['auth'])
    ->group(function () {

        Route::get('/team-employees',
            [TeamEmployeeController::class, 'index'])
            ->name('manager.team.index');

        Route::get('/team-employees/{id}',
            [TeamEmployeeController::class, 'show'])
            ->name('manager.team.show');

        // EDIT
        Route::get('/team-employees/{id}/edit',
            [TeamEmployeeController::class, 'edit'])
            ->name('manager.team.edit');

        // UPDATE
        Route::put('/team-employees/{id}',
            [TeamEmployeeController::class, 'update'])
            ->name('manager.team.update');


    });
use App\Http\Controllers\Manager\TaskController;

Route::prefix('manager')
    ->middleware(['auth'])
    ->group(function () {

        // DAILY WORK LIST
        Route::get('/tasks',
            [TaskController::class, 'index'])
            ->name('manager.tasks.index');

        // APPROVE
        Route::post('/tasks/{id}/approve',
            [TaskController::class, 'approve'])
            ->name('manager.tasks.approve');

        // REJECT
        Route::post('/tasks/{id}/reject',
            [TaskController::class, 'reject'])
            ->name('manager.tasks.reject');

    });
