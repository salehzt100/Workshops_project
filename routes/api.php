<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\v1\EmployeeController;
use App\Http\Controllers\v1\EmployeeOvertimeController;
use App\Http\Controllers\v1\WorkshopsController;
use App\Http\Controllers\v1\CheckController;
use App\Http\Controllers\v1\VehiclesController;
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


// Vehicles  routes

Route::prefix('/v1')->group(function () {

    Route::GET('vehicles', [VehiclesController::class, 'index']);
    Route::GET('vehicles/{id}', [VehiclesController::class, 'show']);
    Route::PUT('vehicles/{id}', [VehiclesController::class,'update']);
    Route::POST('vehicles', [VehiclesController::class, 'add']);
    Route::DELETE('vehicles/{id}', [VehiclesController::class,'delete']);
    Route::GET('vehicles/{id}/payments',[VehiclesController::class,'getPayments']);
    Route::POST('vehicles/{id}/payments', [VehiclesController::class,'setPayments']);


});


//   check routs

Route::prefix('/v1')->group(function () {

    Route::GET('checks', [CheckController::class, 'index']);

    Route::GET('checks/{id}', [checkController::class, 'show']);
    Route::PUT('checks/{id}', [checkController::class,'update']);
    Route::POST('checks', [checkController::class, 'add']);
    Route::DELETE('checks/{id}', [checkController::class,'delete']);

});
