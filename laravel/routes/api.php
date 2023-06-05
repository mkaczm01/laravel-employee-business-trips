<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\EmployeeBusinessTripController;

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

// EMPLOYEE
Route::post('/employee', [EmployeeController::class, 'store'])->name('employee.store');

// EMPLOYEE BUSINESS TRIPP
Route::get('/employee/{employee}/business-trip', [EmployeeBusinessTripController::class, 'index'])->name('employee.business-trip.index');
Route::post('/employee/{employee}/business-trip', [EmployeeBusinessTripController::class, 'store'])->name('employee.business-trip.store');
