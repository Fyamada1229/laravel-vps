<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UsersResource;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        $user = User::all();
        return new UsersResource($user);
    }

    public function show($id)
    {
        $user = User::find($id);
        return new UsersResource($user);
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->fill($request->all())->save();

        return new UsersResource($user);
    }
}
