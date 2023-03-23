<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UsersController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('users', [UsersController::class, 'index']);
Route::get('users/{id}', [UsersController::class, 'show']);
Route::post('store', [UsersController::class, 'store']);
