<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $account_id = intval($request->account_id);

        $user = new User([
            'name' => $request->name,
            'account_id' => $account_id,
            'password' => Hash::make($request->password),
        ]);

        // アカウントIDが既に存在するか確認
        $existingUser = User::where('account_id', $account_id)->first();

        if ($existingUser) {
            return response()->json([
                'message' => "同じAccountIDが登録してあります。",
            ], 409); // 409 Conflict を返す
        }

        $user->save();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }


    public function login(Request $request)
    {
        $user = User::where('account_id', $request->account_id)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['メールアドレス、パスワードのどちらかが一致しません']
            ], 404);
        }

        $token = $user->createToken('my-app-token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }
}
