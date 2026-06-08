<?php

use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});



Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.post');

    Route::get('/employee-register', [AuthController::class, 'showEmployeeRegister'])
        ->name('employee.register');

    Route::post('/employee-register', [AuthController::class, 'employeeRegister'])
        ->name('employee.register.store');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


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



Route::get('/search', [SearchController::class, 'index'])
    ->name('search.global');
Route::get('/global-live-search', [SearchController::class, 'liveSearch'])
    ->name('search.live');
