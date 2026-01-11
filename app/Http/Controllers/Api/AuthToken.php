<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class AuthToken extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email'       => 'required|email',
            'password'    => 'required|string|min:8',
            'device_name' => 'string|nullable',
             'abilities'   => 'array|nullable',
        ]);

        $user = Admin::where('email', $request->email)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'The provided credentials are incorrect.'
            ], 401);
        }

        $device = $request->device_name ?? $request->userAgent();
        $token = $user->createToken($device, $request->post('abilities'))->plainTextToken;

        return response()->json([
            'token' => $token,
            'user'  => $user,
        ], 201);
    }

    public function destroy(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully. Current session terminated.'
        ], 200);
    }
}
