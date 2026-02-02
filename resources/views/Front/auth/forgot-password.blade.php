<x-front-layout title="Forgot Password">

    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <div class="card login-form p-4 shadow-sm" style="border-radius: 1.5rem;">

                        <div class="mb-6 text-center">
                            <h4 class="text-xl font-bold text-gray-800">Forgot Password?</h4>
                            <p class="mt-2 text-sm text-gray-600 leading-relaxed">
                                {{ __('No problem. Just let us know your email address and we will email you a password reset link.') }}
                            </p>
                        </div>

                        <x-auth-session-status class="mb-4 text-center text-green-600 font-medium" :status="session('status')" />

                        <form method="POST" action="{{ route('user.password.email') }}">
                            @csrf

                            <div class="mb-4 text-left">
                                <label for="email"
                                    class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1"
                                    style="color: #6c757d !important; display: block; margin-bottom: 5px;">
                                    Email Address
                                </label>

                                <x-form.input id="email"
                                    class="block w-full border-none bg-gray-100 focus:bg-gray-200 focus:ring-0 rounded-xl p-3 text-gray-800"
                                    type="email" name="email" :value="old('email')" required autofocus
                                    placeholder="Enter your email" />

                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div class="mt-12 mb-1">
                                <div class="button">
                                    <button class="btn" type="submit">{{ __('Send Reset Link') }}</button>
                                </div>
                            </div>

                            <div class="mt-6 text-center">
                                <a href="{{ route('login') }}"
                                    class="text-sm font-bold text-blue-600 hover:text-blue-800 no-underline">
                                    <i class="fas fa-arrow-left text-xs mr-1"></i> Back to Login
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-front-layout>
