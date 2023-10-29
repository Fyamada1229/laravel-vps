<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UsersController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\EmployeeAttendancesController;
use App\Http\Controllers\API\DepartureController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/



Route::post('register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
//ログインしたユーザのみの情報
Route::middleware('auth:sanctum')->get('current-user', [UsersController::class, 'getCurrentUser']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('users', [UsersController::class, 'index']);
    Route::get('users/{id}', [UsersController::class, 'show']);
    Route::post('users/edit', [UsersController::class, 'edit']);
    Route::post('users/employee_attendance', [EmployeeAttendancesController::class, 'store']);
    Route::post('employee_attendance/update', [EmployeeAttendancesController::class, 'update']);
    Route::get('get_employee_attendance', [EmployeeAttendancesController::class, 'show']);
    Route::post('users/departure', [DepartureController::class, 'store']);
    Route::post('users/departure/update', [DepartureController::class, 'update']);
    Route::get('get_departure', [DepartureController::class, 'show']);
});



Route::middleware('auth:sanctum')->post('/logout', function (Request $request) {
    $request->user()->tokens()->delete();
    return response()->json(['message' => 'Logged out.']);
});

Route::get('product', [ProductController::class, 'index']);
Route::get('product/{id}', [ProductController::class, 'show']);
Route::post('product/store', [ProductController::class, 'store']);
