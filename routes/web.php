<?php

use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\HRController;
use App\Http\Controllers\EmployeePortalController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('users', UserController::class);
    Route::resource('positions', PositionController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('positions', PositionController::class);
    Route::resource('employees', EmployeeController::class);
});

// HR Routes
Route::middleware(['auth', 'role:hr'])->prefix('hr')->group(function () {
    Route::get('/dashboard', [HRController::class, 'dashboard'])->name('hr.dashboard');
    Route::resource('employees', EmployeeController::class);
    Route::resource('attendance', AttendanceController::class);
    Route::get('/attendance/{attendance}/edit', [AttendanceController::class, 'edit'])->name('attendance.edit');
    Route::put('/attendance/{attendance}', [AttendanceController::class, 'update'])->name('attendance.update');

    Route::get('/performance/evaluate', [PerformanceController::class, 'create'])->name('performance.create');
    Route::post('/performance', [PerformanceController::class, 'store'])->name('performance.store');
});

// Employee Routes
Route::middleware(['auth', 'role:employee'])->prefix('employee')->group(function () {
    Route::get('/dashboard', [EmployeeController::class, 'dashboard'])->name('employee.dashboard');
    Route::get('/profile', [EmployeeController::class, 'profile'])->name('employee.profile');
});
// Employee Self-Service Routes
Route::middleware(['auth', 'role:employee'])->prefix('employee')->group(function () {
    Route::get('/dashboard', [EmployeePortalController::class, 'dashboard'])->name('employee.dashboard');
    Route::post('/time-in', [EmployeePortalController::class, 'timeIn'])->name('employee.timeIn');
    Route::post('/time-out', [EmployeePortalController::class, 'timeOut'])->name('employee.timeOut');
    Route::get('/performance-history', [EmployeePortalController::class, 'performanceHistory'])->name('employee.performance.history');
});

Route::get('/home', function () {
    if (auth()->check()) {
        $role = auth()->user()->role;
        
        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($role === 'hr') {
            return redirect()->route('hr.dashboard');
        } else {
            return redirect()->route('employee.dashboard');
        }
    }
    return redirect('/login');
})->name('home');