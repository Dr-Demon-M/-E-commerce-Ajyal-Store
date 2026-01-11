<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-4 text-center">
        <h4 class="fw-bold" style="color: #333 !important;">Welcome Back</h4>
        <p class="small" style="color: #6c757d !important;">Please login to your account</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="small fw-bold text-uppercase"
                style="color: #6c757d !important; display: block; margin-bottom: 5px;">Email Address or Phone Number</label>
            <x-text-input id="email" class="block mt-1 w-full shadow-none"
                style="background-color: #f8f9fa !important; border: none !important; padding: 12px !important; border-radius: 10px !important; color: #333 !important;"
                type="text" name="{{ config('fortify.username') }}" :value="old('email')" required autofocus autocomplete="username"
                placeholder="name@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4 mb-2">
            <label for="password" class="small fw-bold text-uppercase"
                style="color: #6c757d !important; display: block; margin-bottom: 5px;">Password</label>
            <x-text-input id="password" class="block mt-1 w-full shadow-none"
                style="background-color: #f8f9fa !important; border: none !important; padding: 12px !important; border-radius: 10px !important; color: #333 !important;"
                type="password" name="password" required autocomplete="current-password" placeholder="Enter Your Password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" name="remember"
                    style="border-radius: 4px !important; border-color: #ced4da !important; color: #007bff !important;">
                <span class="ms-2 text-sm" style="color: #6c757d !important;">Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm fw-bold" href="{{ route('password.request') }}"
                    style="color: #007bff !important; text-decoration: none !important;">
                    Forgot password?
                </a>
            @endif
        </div>

        <div class="mt-4 pt-2">
            <x-primary-button class="w-full justify-center shadow-sm"
                style="background-color: #007bff !important; color: #ffffff !important; border-radius: 50px !important; padding: 12px !important; border: none !important; font-weight: bold !important; display: flex; align-items: center;">
                <i class="fas fa-sign-in-alt me-2" style="margin-right: 8px;"></i> Log in
            </x-primary-button>
        </div>

        <div class="mt-4 text-center">
            <p class="small" style="color: #6c757d !important;">Don't have an account?
                <a href="{{ route('register') }}" class="fw-bold"
                    style="color: #007bff !important; text-decoration: none !important;">Register now</a>
            </p>
        </div>
    </form>
</x-guest-layout>
