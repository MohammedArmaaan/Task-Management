<?php

use App\Http\Controllers\AppAttendanceController;
use App\Http\Controllers\AppTasksController;
use App\Http\Controllers\AppUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\AppUserController as ControllersAppUserController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AppUserController::class, 'register']);
Route::post('/login',[AppUserController::class,'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AppUserController::class, 'logout']);
    Route::get('/employees', [AppUserController::class, 'viewEmployees']);
    Route::get('/tasks', [AppUserController::class, 'viewAssignedTasks']);
    Route::post('/tasks/{id}/status', [AppUserController::class, 'updateTaskStatus']);

});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/tasks', [AppTasksController::class, 'index']);
    Route::post('/tasks', [AppTasksController::class, 'store']);
    Route::get('/tasks/{id}', [AppTasksController::class, 'show']);
    Route::put('/tasks/{id}', [AppTasksController::class, 'update']);
    Route::delete('/tasks/{id}', [AppTasksController::class, 'destroy']);
});
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/checkin',  [AppAttendanceController::class, 'checkIn']);
    Route::post('/checkout', [AppAttendanceController::class, 'checkOut']);
    Route::post('/markpresent', [AppAttendanceController::class, 'markpresent']);
    Route::post('/goinghome', [AppAttendanceController::class, 'goinghome']);
});
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/admin/attendancelist', [AppAttendanceController::class, 'adminAttendanceList']);
});
