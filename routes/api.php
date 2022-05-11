<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\AuhtController;
use App\Http\Controllers\Api\LeaveTypeController;
use App\Http\Controllers\Api\LeaveRequestController;
 
 

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuhtController::class, 'login']);

Route::middleware(['auth:api'])->group(function () {
    Route::post('employees/check', [ApiController::class, 'check']);
    Route::get('employees/attendance/my-status', [ApiController::class, 'MyStatus']);
    Route::resource('leaveTypes', LeaveTypeController::class);
    Route::resource('leaveRequests', LeaveRequestController::class);
    
});
