<x-guest-layout>
    <div class="flex flex-col items-center mb-6">
        <a href="/">
            <img src="{{ asset('/images/logo.png') }}" alt="Logo Toko Koi A3" class="w-20 h-20 object-contain">
        </a>
        <h2 class="text-2xl font-bold text-white mt-2">TOKO KOI A3</h2>
    </div>

    <h3 class="text-xl font-semibold text-white-custom text-center-custom mb-4">Login</h3>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-custom">
            <label for="email" class="block text-sm font-medium text-white-custom">{{ __('Email') }}</label>
            <x-text-input id="email" class="block mt-1 w-full form-input" type="email" name="email"
                :value="old('email')" required autofocus autocomplete="username" placeholder="username@gmail.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
        </div>

        <div class="mb-3">
            <label for="password" class="block text-sm font-medium text-white-custom">{{ __('Password') }}</label>
            <x-text-input id="password" class="block mt-1 w-full form-input" type="password" name="password" required
                autocomplete="current-password" placeholder="Password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
        </div>

        <div class="text-sm mt-1">
            @if (Route::has('password.request'))
                <a class="text-white-custom hover:underline" href="{{ route('password.request') }}">
                    {{ __('lupa password?') }}
                </a>
            @endif
        </div>

        <x-primary-button class="btn-primary">
            {{ __('Login') }}
        </x-primary-button>
    </form>

    <div class="mt-8 text-center-custom">
        <p class="text-sm-custom text-white-custom">
            {{ __('Belum memiliki akun?') }}
            <a href="{{ route('register') }}" class="font-bold text-white-custom hover:underline-custom">
                {{ __('Register di sini') }}
            </a>
        </p>
    </div>
    </form>
</x-guest-layout>
