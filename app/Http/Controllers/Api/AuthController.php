<?php

namespace App\Http\Controllers\Api;

use App\Enum\ApiStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        // validate
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => ApiStatus::Failed,
                'message' => $validator->messages()->first()
            ], 400);
        }

        // check user data
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'status' => ApiStatus::Failed,
                'message' => 'User does not exist'
            ], 404);
        }

        // check password matches
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => ApiStatus::Failed,
                'message' => 'Passwords do not match'
            ], 400);
        }

        // create token
        $token = $user->createToken('token')->plainTextToken;

        // send request
        return response()->json([
            'status' => ApiStatus::Success,
            'data' => [
                'token' => $token,
                'user' => new UserResource($user),
            ]
        ], 200);
    }


    public function logout(Request $request)
    {
        // remove current token from db
        $request->user()->currentAccessToken()->delete();

        // send request
        return response()->json([
            'status' => ApiStatus::Success,
            'message' => 'Logout successful'
        ], 200);
    }
}
