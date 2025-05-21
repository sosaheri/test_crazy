<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('auth.welcome');
})->name("welcome");

// Rutas de Registro
Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup.show');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup.store');

// Rutas de Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
});

Route::middleware(['role:manager'])->group(function () {
    Route::get('/manager/dashboard', [DashboardController::class, 'managerDashboard'])->name('manager.dashboard');
});

Route::resource('students', StudentController::class);
