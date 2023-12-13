<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\v1\EmployeeController;
use App\Http\Controllers\v1\EmployeeOvertimeController;
use App\Http\Controllers\v1\WorkshopsController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



// Employee routes

Route::prefix('/v1')->group(function () {
    Route::GET('employees', [EmployeeController::class, 'index']);
    Route::GET('employees/{id}', [EmployeeController::class, 'show']);
    Route::PUT('employees/{id}', [EmployeeController::class,'update']);
    Route::POST('employees', [EmployeeController::class, 'create']);
    Route::DELETE('employees/{id}', [EmployeeController::class,'delete']);
});

// EmployeeOvertime routes

Route::prefix('/v1')->group(function () {
    Route::PUT('employeeOvertimes/{id}', [EmployeeOvertimeController::class,'update']);
    Route::POST('employee/{id}/employeeOvertimes', [EmployeeOvertimeController::class, 'add']);
    Route::DELETE('employeeOvertimes/{id}', [EmployeeOvertimeController::class,'delete']);
});

// Workshops routes

Route::prefix('/v1')->group(function () {

    Route::GET('workshops', [WorkshopsController::class, 'index']);
    Route::GET('workshops/{id}', [WorkshopsController::class, 'show']);
    Route::PUT('workshops/{id}', [WorkshopsController::class,'update']);
    Route::POST('/workshops', [WorkshopsController::class, 'add']);
    Route::DELETE('workshops/{id}', [WorkshopsController::class,'delete']);
    Route::GET('workshops/{id}/payments',[WorkshopsController::class,'getPayments']);
    Route::POST('workshops/{id}/payments', [WorkshopsController::class,'setPayments']);
    Route::GET('workshops/{id}/vehicles',[WorkshopsController::class,'getVehicles']);


});

