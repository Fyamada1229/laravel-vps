<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UsersResource;
use App\Models\User;
use App\Services\UsersService;

class UsersController extends Controller
{

    public function index(UsersService $service)
    {
        $user = $service->index();
        return new UsersResource($user);
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
