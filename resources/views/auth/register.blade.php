<x-guest-layout>
    <div class="flex flex-col items-center mb-6">
        <a href="/">
            <img src="{{ asset('/images/logo.png') }}" alt="Logo Toko Koi A3" class="w-20 h-20 object-contain">
        </a>
        <h2 class="text-2xl font-bold text-white mt-2">TOKO KOI A3</h2>
    </div>

    <h3 class="text-xl font-semibold text-white-custom text-center-custom mb-4">Registrasi</h3>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!--username -->
        <div class="mb-custom">
            <label for="name" class="block text-sm font-medium text-white-custom">{{ __('Name') }}</label>
            <x-text-input id="name" class="block mt-1 w-full form-input" type="text" name="name"
                :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="block text-sm font-medium text-white-custom" />
            <x-text-input id="email" class="block mt-1 w-full form-input" type="email" name="email"
                :value="old('email')" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="block text-sm font-medium text-white-custom" />

            <x-text-input id="password" class="block mt-1 w-full form-input" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')"
                class="block text-sm font-medium text-white-custom" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full form-input" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <x-primary-button class="btn-primary">
            {{ __('Register') }}
        </x-primary-button>


        <div class="mt-8 text-center-custom">
            <p class="text-sm-custom text-white-custom">
                {{ __('Sudah Memiliki Akun?') }}
                <a href="{{ route('login') }}" class="font-bold text-white-custom hover:underline-custom">
                    {{ __('Login di sini') }}
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
