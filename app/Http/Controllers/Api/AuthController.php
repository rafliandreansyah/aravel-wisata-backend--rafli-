<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        // validate
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // check user data
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'status' => 404,
                'error_message' => 'User does not exist'
            ], 404);
        }

        // check password matches
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 400,
                'error_message' => 'Passwords do not match'
            ], 400);
        }

        // create token
        $token = $user->createToken('token')->plainTextToken;

        // send request
        return response()->json([
            'status' => 200,
            'data' => [
                'token' => $token,
                'user' => new UserResource($user),
            ]
        ], 200);
    }
}
