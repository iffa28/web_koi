<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">


    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased" x-data="{ sidebarOpen: false, sidebarCollapsed: localStorage.getItem('sidebarCollapsed') === 'true' }" x-init="$watch('sidebarCollapsed', value => localStorage.setItem('sidebarCollapsed', value))">
    @php
        $role = Auth::check() ? Auth::user()->role : null;
    @endphp

    <div class="flex h-screen bg-gray-100 dark:bg-gray-900">

        {{-- Sidebar untuk admin --}}
        @if ($role === 'admin')
            @if (!request()->routeIs('dashboard'))
                {{-- Sidebar desktop --}}
                <div class="hidden md:flex transition-all duration-300 ease-in-out"
                    :class="{ 'w-64': !sidebarCollapsed, 'w-13': sidebarCollapsed }">
                    @include('layouts.sidebar')
                </div>

                {{-- Sidebar mobile --}}
                <div x-show="sidebarOpen" class="fixed inset-0 flex z-40 md:hidden" x-cloak>
                    <div x-show="sidebarOpen" @click="sidebarOpen = false"
                        x-transition:enter="transition-opacity ease-linear duration-300"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        x-transition:leave="transition-opacity ease-linear duration-300"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                        class="fixed inset-0 bg-gray-600 bg-opacity-75"></div>

                    <div x-show="sidebarOpen" x-transition:enter="transition ease-in-out duration-300 transform"
                        x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                        x-transition:leave="transition ease-in-out duration-300 transform"
                        x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                        class="relative flex-1 flex flex-col max-w-xs w-full bg-gray-800">
                        @include('layouts.sidebar')
                    </div>
                </div>
            @endif
        @endif

        <div class="flex-1 flex flex-col overflow-hidden">
            @if (Auth::user()->role === 'admin')
                <header
                    class="flex justify-between items-center py-4 px-6 bg-gray-900 text-gray-300 dark:bg-gray-800 border-b dark:border-blue-700">
                    <div class="flex items-center">
                        {{-- Tombol Toggle Sidebar --}}
                        <button @click="sidebarCollapsed = !sidebarCollapsed"
                            class="hidden md:block text-gray-500 mr-4 focus:outline-none p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </button>
                        {{-- Tombol Hamburger Mobile --}}
                        <button @click.stop="sidebarOpen = !sidebarOpen"
                            class="md:hidden text-gray-500 mr-4 focus:outline-none">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>

                        {{-- Judul Halaman dari Slot --}}
                        @if (isset($header))
                            {{ $header }}
                        @endif
                    </div>

                    {{-- <div class="shrink-0 flex items-center">
                        <a href="{{ route('dashboard') }}">
                            <img src="{{ asset('/images/logo.png') }}" alt="Logo Toko Koi A3"
                                class="w-10 h-10 object-contain">
                        </a>
                        {{ __('A3 KOI Farm') }}
                    </div> --}}


                    {{-- Tombol Logout --}}
                    <div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg text-sm transition-colors">
                                {{ __('Logout') }}
                            </button>
                        </form>
                    </div>
                </header>
            @endif

            {{-- Navbar untuk customer --}}
            @if ($role === 'customer')
                @include('layouts.navigation')
            @endif

            {{-- Konten --}}
            <main
                class="flex-1 overflow-x-hidden overflow-y-auto {{ $role === 'admin' ? 'bg-blue-900' : 'bg-blue-900' }}">
                <div class="container mx-auto px-6 py-8">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
</body>

</html>
