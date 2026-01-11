<x-guest-layout>
    <div class="mb-6 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 rounded-full mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
        </div>
        
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">
            {{ __('تأكيد الهوية') }}
        </h2>
        <p class="text-sm text-gray-600 dark:text-gray-400 px-4">
            {{ __('هذه منطقة آمنة. يرجى تأكيد كلمة المرور الخاصة بك للمتابعة.') }}
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
        @csrf

        <div class="relative">
            <x-input-label for="password" :value="__('كلمة المرور')" class="font-medium" />
            
            <div class="mt-1 relative group">
                <x-text-input id="password" 
                    class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 focus:ring-indigo-500 focus:border-indigo-500 rounded-lg shadow-sm transition duration-150 ease-in-out"
                    type="password"
                    name="password"
                    required 
                    autocomplete="current-password" 
                    placeholder="••••••••" />
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm" />
        </div>

        <div class="flex flex-col space-y-3">
            <x-primary-button class="w-full justify-center py-3 text-base font-semibold tracking-wide shadow-lg shadow-indigo-500/20">
                {{ __('تأكيد الدخول') }}
            </x-primary-button>
            
            <a href="javascript:history.back()" class="text-center text-sm text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 transition-colors">
                {{ __('إلغاء') }}
            </a>
        </div>
    </form>
</x-guest-layout>