<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DetailLoanController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\UsersController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('room', RoomController::class);
    Route::apiResource('type', TypeController::class);
    Route::apiResource('employee', EmployeeController::class);
    Route::apiResource('inventory', InventoryController::class);
    Route::apiResource('loan', LoanController::class);
    Route::apiResource('detailLoan', DetailLoanController::class);
});
Route::apiResource('user', UsersController::class);
Route::post('login', [AuthenticationController::class, 'login']);