<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Socialite;
use Psy\Util\Str;
use Throwable;

class SocialAuthController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect(); // redirect to provider auth page
    }

    public function callback($provider)
    {
        try {

            $provider_user = Socialite::driver($provider)->stateless()->user(); // get user info from provider
            $user = User::where('provider', $provider)
                ->where('provider_id', $provider_user->id)
                ->first();

            if (!$user) {
                $user = User::create([
                    'name' => $provider_user->name,
                    'email' => $provider_user->email,
                    'password' => null,
                    'provider' => $provider,
                    'provider_id' => $provider_user->id,
                    'provider_token' => $provider_user->token,
                    'email_verified_at' => now(),
                ]);
            }
            Auth::login($user);
            return redirect()->route('home');
        } catch (Throwable $e) {
            return redirect()->route('user.login')->withErrors([
                'email' => $e->getMessage()
            ]);
        }
    }
}
