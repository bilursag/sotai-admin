<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <!--<div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div> -->

        <div>
            <x-input-label for="login" :value="__('Email or RUT')" />
            <x-text-input id="login" class="block mt-1 w-full" type="text" name="login" :value="old('login')"
                required autofocus />
            <x-input-error :messages="$errors->get('login')" class="mt-2" />
        </div>

        <input type="hidden" id="no_format_rut" name="no_format_rut">

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                    name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

<script>
    document.getElementById('login').addEventListener('input', function(e) {
        let input = e.target.value;

        if (/^[0-9kK]+$/.test(input.replace(/[.-]/g, ''))) {
            let rut = input.replace(/[^0-9kK]/g, '');
            let noFormatRut = rut;

            if (rut.length > 1) {
                rut = rut.slice(0, -1) + '-' + rut.slice(-1).toUpperCase();
            }
            if (rut.length > 2) {
                rut = rut.slice(0, -2).replace(/\B(?=(\d{3})+(?!\d))/g, '.') + rut.slice(-2);
            }

            e.target.value = rut;

            document.getElementById('no_format_rut').value = noFormatRut;
        }
    });
</script>
