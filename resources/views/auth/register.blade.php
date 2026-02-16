<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Full Name')" class="text-gray-700 dark:text-gray-300" />
            <x-text-input id="name"
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="username" :value="__('Username')" class="text-gray-700 dark:text-gray-300" />
            <x-text-input id="username"
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                type="text" name="username" :value="old('username')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email Address')" class="text-gray-700 dark:text-gray-300" />
            <x-text-input id="email"
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="phone_number" :value="__('Phone Number')" class="text-gray-700 dark:text-gray-300" />
            <x-text-input id="phone_number"
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                type="number" name="phone_number" :value="old('phone_number')" required />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-1" />
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <x-input-label for="password" :value="__('Password')" class="text-gray-700 dark:text-gray-300" />
                <x-text-input id="password"
                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                    type="password" name="password" required autocomplete="new-password" />
            </div>
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')"
                    class="text-gray-700 dark:text-gray-300" />
                <x-text-input id="password_confirmation"
                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                    type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>
        </div>
        <x-input-error :messages="$errors->get('password')" class="mt-1" />

        <div class="flex items-center justify-between mt-6">
            <a class="text-sm text-indigo-600 hover:text-indigo-900 transition-colors duration-200 font-medium"
                href="{{ route('login') }}">
                {{ __('Already have an account?') }}
            </a>

            <x-primary-button
                class="bg-indigo-600 hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 shadow-lg">
                {{ __('Create Account') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
