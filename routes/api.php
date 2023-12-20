<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\v1\EmployeeController;
use App\Http\Controllers\v1\EmployeeOvertimeController;
use App\Http\Controllers\v1\WorkshopsController;
use App\Http\Controllers\v1\CheckController;
use App\Http\Controllers\v1\VehiclesController;
use App\Http\Controllers\v1\OwnersController;
use App\Http\Controllers\v1\WorkshopFinancialProcessController;
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
    Route::PUT('employees/{id}', [EmployeeController::class, 'update']);
    Route::POST('employees', [EmployeeController::class, 'create']);
    Route::DELETE('employees/{id}', [EmployeeController::class, 'delete']);
});

// EmployeeOvertime routes

Route::prefix('/v1')->group(function () {
    Route::PUT('employeeOvertimes/{id}', [EmployeeOvertimeController::class, 'update']);
    Route::POST('employee/{id}/employeeOvertimes', [EmployeeOvertimeController::class, 'add']);
    Route::DELETE('employeeOvertimes/{id}', [EmployeeOvertimeController::class, 'delete']);
});

// Workshops routes

Route::prefix('/v1')->group(function () {

    Route::GET('workshops', [WorkshopsController::class, 'index']);
    Route::GET('workshops/{id}', [WorkshopsController::class, 'show']);
    Route::PUT('workshops/{id}', [WorkshopsController::class, 'update']);
    Route::POST('/workshops', [WorkshopsController::class, 'add']);
    Route::DELETE('workshops/{id}', [WorkshopsController::class, 'delete']);
    Route::GET('workshops/{id}/payments', [WorkshopsController::class, 'getPayments']);
    Route::POST('workshops/{id}/payments', [WorkshopsController::class, 'setPayments']);
    Route::GET('workshops/{id}/vehicles', [WorkshopsController::class, 'getVehicles']);
    Route::POST('workshops/{workshop_id}/vehicles/{vehicle_id}', [WorkshopsController::class, 'setVehicles']);
    Route::GET('workshops/{id}/workshopFinancials', [WorkshopsController::class, 'getWorkshopFinancial']);
    Route::POST('workshops/{id}/workshopFinancials', [WorkshopsController::class, 'setFinancialProcess']);



});


// Vehicles  routes

Route::prefix('/v1')->group(function () {

    Route::GET('vehicles', [VehiclesController::class, 'index']);
    Route::GET('vehicles/{id}', [VehiclesController::class, 'show']);
    Route::PUT('vehicles/{id}', [VehiclesController::class, 'update']);
    Route::POST('vehicles', [VehiclesController::class, 'add']);
    Route::DELETE('vehicles/{id}', [VehiclesController::class, 'delete']);
    Route::GET('vehicles/{id}/payments', [VehiclesController::class, 'getPayments']);
    Route::POST('vehicles/{id}/payments', [VehiclesController::class, 'setPayments']);
    Route::GET('vehicles/{id}/expenses', [VehiclesController::class, 'getExpenses']);
    Route::POST('vehicles/{id}/expenses', [VehiclesController::class, 'setExpenses']);

});


//   check routs

Route::prefix('/v1')->group(function () {

    Route::GET('checks', [CheckController::class, 'index']);
    Route::GET('checks/{id}', [checkController::class, 'show']);
    Route::PUT('checks/{id}', [checkController::class, 'update']);
    Route::POST('checks', [checkController::class, 'add']);
    Route::DELETE('checks/{id}', [checkController::class, 'delete']);

});




// Owner routes

Route::prefix('/v1')->group(function () {
    Route::GET('owners', [OwnersController::class, 'index']);
    Route::GET('owners/{id}', [OwnersController::class, 'show']);
    Route::PUT('owners/{id}', [OwnersController::class, 'update']);
    Route::POST('owners', [OwnersController::class, 'add']);
    Route::DELETE('owners/{id}', [OwnersController::class, 'delete']);
});



// workshop financial routes

Route::prefix('/v1')->group(function () {
    Route::GET('workshopFinancials', [WorkshopFinancialProcessController::class, 'index']);
    Route::GET('workshopFinancials/{id}', [WorkshopFinancialProcessController::class, 'show']);
    Route::PUT('workshopFinancials/{id}', [WorkshopFinancialProcessController::class, 'update']);
    Route::DELETE('workshopFinancials/{id}', [WorkshopFinancialProcessController::class, 'delete']);
});
