<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UsersResource;
use App\Models\User;
use App\Models\EmployeeAttendance;
use App\Models\Departure;
use App\Http\Services\UsersService;

class UsersController extends Controller
{

    public function index(UsersService $service)
    {
        $user = $service->index();
        return new UsersResource($user);
    }

    public function new(Request $id)
    {
        $user = EmployeeAttendance::find($id);
        return new UsersResource($user);
    }

    public function show($id)
    {
        $user = User::find($id);
        return new UsersResource($user);
    }

    public function edit(Request $data, UsersService $service)
    {
        $user = $service->edit($data);
        return $user;
    }

    public function update(Request $request, UsersService $service)
    {
        $user = $service->update($request);
        return $user;
    }

    public function getCurrentUser()
    {
        // 認証されたユーザーの取得
        $user = Auth::user();
        // ユーザー情報を返す
        return response()->json(['user' => $user], 200);
    }
}
