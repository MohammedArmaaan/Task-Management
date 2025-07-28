<?php

use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

//View's Routes :
Route::get('/', fn() => view('login'));
Route::get('/register', [LoginController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [LoginController::class, 'register'])->name('register.post');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/assigned-tasks/{id}', [TaskController::class, 'assignedTasks'])->name('assigned.tasks');
Route::get('/employees', [UserController::class, 'viewEmployees'])->name('viewEmployee');

//Admin Routes : 
Route::middleware(['auth:user', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AttendanceController::class, 'adminAttendanceList'])->name('dashboard.admin');
    Route::prefix('admin/tasks')->name('tasks.')->group(function () {
        Route::get('/', [TaskController::class, 'index'])->name('index');
        Route::get('/{id}', [TaskController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [TaskController::class, 'edit'])->name('edit');
        Route::put('/{id}', [TaskController::class, 'update'])->name('update');
        Route::delete('/{id}', [TaskController::class, 'destroy'])->name('destroy');
    });
});
//Task Create Routes :
Route::middleware(['auth:user', 'role:admin,employee'])
    ->prefix('tasks')
    ->name('tasks.')
    ->group(function () {
        Route::get('/create', [TaskController::class, 'create'])->name('create');
        Route::post('/store', [TaskController::class, 'store'])->name('store');
    });


//Employee Routes :
Route::middleware(['auth:user', 'role:employee'])->group(function () {
    Route::get('/User/dashboard', fn() => view('Employee.employee'))->name('dashboard.employee');
    Route::get('/assigned-tasks', [UserController::class, 'viewAssignedTasks'])->name('tasks.assigned');
    Route::post('/assigned-tasks/update/{id}', [UserController::class, 'updateTaskStatus'])->name('employee.task.update');
});

//For Pesrent/Checkin/Checkout/Goinghome : 
Route::middleware(['auth:user'])->group(function () {
    Route::post('/attendance/present', [AttendanceController::class, 'markPresent'])->name('attendance.present');
    Route::post('/attendance/checkin', [AttendanceController::class, 'checkIn'])->name('attendance.checkin');
    Route::post('/attendance/checkout', [AttendanceController::class, 'checkOut'])->name('attendance.checkout');
    Route::post('/attendance/going', [AttendanceController::class, 'goingHome'])->name('attendance.going');
});
