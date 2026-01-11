<?php

namespace App\Actions\Fortify;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAuthentication
{
    public static function Authentication($request)
    {
        $username = $request->post(config('fortify.username'));
        $password = $request->post('password');
        $user = Admin::where('email', '=', $username)
            ->orWhere('phone_number', '=', $username)
            ->orWhere('username', '=', $username)
            ->first();

        if ($user && Hash::check($password, $user->password)) {
            Auth::guard('admin')->login($user);
        }
        return false;
    }
}
