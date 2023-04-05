<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UsersController;
use App\Http\Controllers\API\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('users/{id}', [UsersController::class, 'show']);
    Route::post('edit', [UsersController::class, 'edit']);
    Route::get('users', [UsersController::class, 'index']);
});

Route::middleware('auth:sanctum')->post('/logout', function (Request $request) {
    $request->user()->tokens()->delete();
    return response()->json(['message' => 'Logged out.']);
});


// Route::get('users', [UsersController::class, 'index']);
// Route::get('users/{id}', [UsersController::class, 'show']);
// Route::post('edit', [UsersController::class, 'edit']);
