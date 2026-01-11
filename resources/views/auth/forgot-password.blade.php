<x-guest-layout>
    <div class="mb-6 text-center">
        <h4 class="text-xl font-bold text-gray-800">Forgot Password?</h4>
        <p class="mt-2 text-sm text-gray-600 leading-relaxed">
            {{ __('No problem. Just let us know your email address and we will email you a password reset link.') }}
        </p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-4">
            <label for="email" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1"
                style="color: #6c757d !important; display: block; margin-bottom: 5px;">Email
                Address</label>
            <x-text-input id="email"
                class="block w-full border-none bg-gray-100 focus:bg-gray-200 focus:ring-0 rounded-xl p-3 text-gray-800"
                type="email" name="email" :value="old('email')" required autofocus placeholder="Enter your email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-6">
            <x-primary-button
                class="w-full justify-center py-3 rounded-full bg-blue-600 hover:bg-blue-700 transition duration-150 ease-in-out">
                <i class="fas fa-paper-plane mr-2 text-xs"></i>
                {{ __('Send Reset Link') }}
            </x-primary-button>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('login') }}" class="text-sm font-bold text-blue-600 hover:text-blue-800 no-underline">
                <i class="fas fa-arrow-left text-xs mr-1"></i> Back to Login
            </a>
        </div>
    </form>
</x-guest-layout>
