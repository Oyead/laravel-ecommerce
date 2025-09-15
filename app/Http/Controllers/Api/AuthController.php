<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * User Registration
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|max:100|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $accessToken = Str::random(64);

        $user = User::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'password'     => bcrypt($request->password),
            'access_token' => $accessToken,
        ]);

        return response()->json([
            'msg'          => 'User registered successfully',
            'access_token' => $accessToken,
        ], 201);
    }

    /**
     * User Login
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email|max:100',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'msg' => 'Invalid email or password',
            ], 401);
        }

        $accessToken = Str::random(64);
        $user->update(['access_token' => $accessToken]);

        return response()->json([
            'msg'          => 'Welcome ' . $user->name . ', login successful',
            'access_token' => $accessToken,
        ], 200);
    }

    /**
     * User Logout
     */
    public function logout(Request $request)
    {
        // Expecting header: Authorization: Bearer <token>
        $accessToken = $request->bearerToken();

        if (!$accessToken) {
            return response()->json([
                'msg' => 'Access token not provided',
            ], 401);
        }

        $user = User::where('access_token', $accessToken)->first();

        if (!$user) {
            return response()->json([
                'msg' => 'Invalid access token',
            ], 401);
        }

        $user->update(['access_token' => null]);

        return response()->json([
            'msg' => 'Logged out successfully',
        ], 200);
    }
}
