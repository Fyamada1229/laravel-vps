<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UsersResource;


class UsersService
{
    public function index()
    {
        $user = User::all();
        return $user;
    }

    public function show($id)
    {
        $user = User::find($id);
        return new UsersResource($user);
    }

    public function edit(Request $id)
    {
        $user = User::find($id);
        return new UsersResource($user);
    }
}
