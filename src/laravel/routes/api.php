<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UsersController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\EmployeeAttendances;

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
    Route::post('users/employee_attendance', [EmployeeAttendances::class, 'store']);
});

Route::middleware('auth:sanctum')->post('/logout', function (Request $request) {
    $request->user()->tokens()->delete();
    return response()->json(['message' => 'Logged out.']);
});


Route::get('product', [ProductController::class, 'index']);
Route::get('product/{id}', [ProductController::class, 'show']);
Route::post('product/store', [ProductController::class, 'store']);
