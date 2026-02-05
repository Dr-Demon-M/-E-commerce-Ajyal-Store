<x-front-layout title="Verify Email">

    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <div class="card login-form p-4 shadow-sm" style="border-radius: 1.5rem;">

                        <div class="mb-6 text-center">
                            <div class="mb-3">
                                <i class="fas fa-envelope-open-text text-blue-600" style="font-size: 3rem;"></i>
                            </div>
                            <h4 class="text-xl font-bold text-gray-800">Verify Your Email</h4>
                            <p class="mt-2 text-sm text-gray-600 leading-relaxed px-2">
                                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?') }}
                            </p>
                            <p class="mt-2 text-xs text-gray-500 italic">
                                {{ __('If you didn\'t receive the email, we will gladly send you another.') }}
                            </p>
                        </div>

                        @if (session('status') == 'verification-link-sent')
                            <div
                                class="mt-4 p-3 rounded-xl bg-green-50 text-sm text-green-700 border border-green-100 text-center font-medium">
                                <i class="fas fa-check-circle mr-1"></i>
                                {{ __('A new verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        <div class="mt-4">
                            <form method="POST" action="{{ route('user.verification.send') }}">
                                @csrf
                                <div class="button">
                                    <button class="btn" type="submit">{{ __('Resend Verification Email') }}</button>
                                </div>
                            </form>

                            <div class="mt-6 text-center">
                                <form method="POST" action="{{ route('user.logout') }}" class="inline">
                                    @csrf
                                    <div class="mt-6 text-center">
                                        <a href="http://127.0.0.1:8000/login"
                                            class="text-sm font-bold text-blue-600 hover:text-blue-800 no-underline">
                                            <i class="fas fa-arrow-left text-xs mr-1"></i> {{ __('Log Out') }}
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-front-layout>
