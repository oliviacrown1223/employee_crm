<?php

use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/admin/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

use App\Http\Controllers\Manager\DashboardController;

Route::prefix('manager')
    ->middleware(['auth'])
    ->group(function () {

        Route::get('/dashboard',
            [DashboardController::class, 'index'])
            ->name('manager.dashboard');

    });


Route::middleware(['auth'])->group(function () {

    Route::get('/admin/profile', [AdminProfileController::class, 'index'])
        ->name('admin.profile');

    Route::post('/admin/profile/update', [AdminProfileController::class, 'updateProfile'])
        ->name('admin.profile.update');

    Route::post('/admin/password/update', [AdminProfileController::class, 'updatePassword'])
        ->name('admin.password.update');

});
Route::get('/employee/register', [AuthController::class, 'showEmployeeRegister']);
Route::post('/employee/register', [AuthController::class, 'employeeRegister']);
