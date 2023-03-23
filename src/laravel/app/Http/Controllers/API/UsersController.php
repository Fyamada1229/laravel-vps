<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UsersResource;
use Illuminate\Foundation\Auth\User;

class UsersController extends Controller
{
    public function index()
    {
        $user = User::all();
        return new UsersResource($user);
    }

    public function show($users)
    {
        $user = User::find($users);
        return new UsersResource($user);
    }
}
