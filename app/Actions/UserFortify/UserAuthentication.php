<?php

namespace App\Actions\UserFortify;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAuthentication
{
    public static function Authentication($request)
    {
        $username = $request->post(config('fortify.username'));
        $password = $request->post('password');
        $user = User::where('email', '=', $username)
            ->orWhere('phone_number', '=', $username)
            ->first();

        if ($user && Hash::check($password, $user->password)) {
            Auth::guard('web')->login($user);
        }
        return false;
    }
}
